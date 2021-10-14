<?php

namespace Odan\Util;

/**
 * System infos for Linux (Ubuntu) and Windows.
 *
 * - Total RAM
 * - Free RAM
 * - Disk size
 * - CPU load in %
 */
class SystemInfo
{
    /**
     * Return RAM Total in Bytes.
     *
     * @return int Bytes
     */
    public function getRamTotal()
    {
        $result = 0;
        if (PHP_OS == 'WINNT') {
            $lines = null;
            $matches = null;
            exec('wmic ComputerSystem get TotalPhysicalMemory /Value', $lines);
            if (preg_match('/^TotalPhysicalMemory\=(\d+)$/', $lines[2], $matches)) {
                $result = $matches[1];
            }
        } else {
            $fh = fopen('/proc/meminfo', 'r');
            while ($line = fgets($fh)) {
                $pieces = array();
                if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                    $result = $pieces[1];
                    // KB to Bytes
                    $result = $result * 1024;
                    break;
                }
            }
            fclose($fh);
        }
        // KB RAM Total
        return (int) $result;
    }

    /**
     * Return free RAM in Bytes.
     *
     * @return int Bytes
     */
    public function getRamFree()
    {
        $result = 0;
        if (PHP_OS == 'WINNT') {
            $lines = null;
            $matches = null;
            exec('wmic OS get FreePhysicalMemory /Value', $lines);
            if (preg_match('/^FreePhysicalMemory\=(\d+)$/', $lines[2], $matches)) {
                $result = $matches[1] * 1024;
            }
        } else {
            $fh = fopen('/proc/meminfo', 'r');
            while ($line = fgets($fh)) {
                $pieces = array();
                if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
                    // KB to Bytes
                    $result = $pieces[1] * 1024;
                    break;
                }
            }
            fclose($fh);
        }
        // KB RAM Total
        return (int) $result;
    }

    /**
     * Get CPU Load Percentage.
     *
     * @return float load percentage
     */
    public function getCpuLoadPercentage()
    {
        $result = -1;
        $lines = null;
        if (PHP_OS == 'WINNT') {
            $matches = null;
            exec('wmic.exe CPU get loadpercentage /Value', $lines);
            if (preg_match('/^LoadPercentage\=(\d+)$/', $lines[2], $matches)) {
                $result = $matches[1];
            }
        } else {
            $checks = array();
            foreach (array(0, 1) as $i) {
                $cmd = '/proc/stat';
                #$cmd = 'grep \'cpu \' /proc/stat <(sleep 1 && grep \'cpu \' /proc/stat) | awk -v RS="" \'{print ($13-$2+$15-$4)*100/($13-$2+$15-$4+$16-$5) "%"}\'';
                #exec($cmd, $lines);
                $lines = array();
                $fh = fopen($cmd, 'r');
                while ($line = fgets($fh)) {
                    $lines[] = $line;
                }
                fclose($fh);
                //$lines = array($tests[$i]);

                foreach ($lines as $line) {
                    $ma = array();
                    if (!preg_match('/^cpu  (\d+) (\d+) (\d+) (\d+) (\d+) (\d+) (\d+) (\d+) (\d+) (\d+)$/', $line, $ma)) {
                        continue;
                    }
                    
                    $total = $ma[1] + $ma[2] + $ma[3] + $ma[4] + $ma[5] + $ma[6] + $ma[7] + $ma[8] + $ma[9];
                    $ma['total'] = $total;
                    $checks[] = $ma;
                    break;
                }

                if ($i == 0) {
                    // Wait before checking again.
                    sleep(1);
                }
            }

            // Idle - prev idle
            $diffIdle = $checks[1][4] - $checks[0][4];

            // Total - prev total
            $diffTotal = $checks[1]['total'] - $checks[0]['total'];

            // Usage in %
            $diffUsage = (1000 * ($diffTotal - $diffIdle) / $diffTotal + 5) / 10;
            $result = $diffUsage;
        }
        return (float) $result;
    }

    function getDisk(){
        $total = round(disk_total_space("/")/ 1024 / 1024 / 1024);
        $available = round(disk_free_space("/")/1024 / 1024 / 1024);
        $used = ($total - $available);
        $getPercentTage =  ceil($total / $used * 100);
        $percentTage = substr($getPercentTage, 1);

        $result['Total Disc'] = $total;
        $result['Available Disc Space'] = $available;  
        $result['Usage Space'] =  $used;
        $result['Percentage Usage Space'] = $percentTage; 

        return $result;
    }
}

$system = new SystemInfo();

