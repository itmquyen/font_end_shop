<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class BatchLogger
{
    /**
     * message wrapper
     *
     * @param  string $batchName
     * @param  string $logType
     * @param  string $detailMsg
     * @return void
     */
    public static function wrapper($batchName, $logType, $detailMsg)
    {
        $message = date('Y-d-m') . ' - ' . date('H:i:s') . ' - ' . $batchName . ' - ' . $logType . ' - ' . $detailMsg;
        if ($logType == 'ERROR') {
            LogHelper::writeBatchErrorLog($batchName, $message);
        } elseif ($logType == 'INFO') {
            LogHelper::writeBatchInfoLog($batchName, $message);
        } elseif ($logType == 'WARNING') {
            LogHelper::writeBatchWarningLog($batchName, $message);
        } else {
            Log::debug($message);
        }
    }

    /**
     * start batch
     *
     * @param  string $name
     * @param  string|null $fileName
     * @return void
     */
    public static function start($name, $fileName = null)
    {
        BatchLogger::wrapper($name, 'INFO', 'Start with ' . $fileName);
    }

    /**
     * end batch
     *
     * @param  string $name
     * @return void
     */
    public static function end($name)
    {
        BatchLogger::wrapper($name, 'INFO', 'Successful completed');
    }

    /**
     * file not exist
     *
     * @param  string $batchName
     * @param  string $fileName
     * @return void
     */
    public static function fileNotExist($batchName, $fileName)
    {
        BatchLogger::wrapper($batchName, 'ERROR', 'File not exists (' . $fileName . ')');
    }

    /**
     * not read permission
     *
     * @param  string $batchName
     * @param  string $fileName
     * @return void
     */
    public static function notReadPermission($batchName, $fileName)
    {
        BatchLogger::wrapper($batchName, 'ERROR', "Don't have right to read file  (" . $fileName . ')');
    }

    /**
     * not write permission
     *
     * @param  string $batchName
     * @param  string $fileName
     * @return void
     */
    public static function notWritePermission($batchName, $fileName)
    {
        BatchLogger::wrapper($batchName, 'ERROR', 'Cannot write to file  (' . $fileName . ')');
    }

    /**
     * incorrect format file
     *
     * @param  string $batchName
     * @param  string|null $fileName
     * @return void
     */
    public static function incorrectFormatFile(string $batchName, string $fileName = null)
    {
        BatchLogger::wrapper($batchName, 'ERROR', 'Incorrect format  (' . $fileName . ')');
    }

    /**
     * incorrect format account item
     *
     * @param  int $line
     * @param  string|null $fileName
     * @return void
     */
    public static function incorrectFormatAccountItem($line, $fileName)
    {
        BatchLogger::wrapper('synchronized_customer_s3', 'ERROR', '[' . $fileName . '] - Line ' . $line . ' - Wrong format');
    }

    /**
     * write log with channel name
     *
     * @param  string $channelName
     * @param  string $startTime
     * @param  string $message
     * @param  mixed $error
     * @return void
     */
    public static function writeBatchLog($channelName, $startTime, $message, $error = null)
    {
        $endDate = DateHelper::parse(format: 'Y-m-d H:i:s');

        if (is_null($error)) {
            Log::channel($channelName)->info($message . "\n" .
                "info:\n"
                . $startTime
                . " start batch\n"
                . $endDate
                . " end batch\n ");
        } else {
            Log::channel($channelName)->error(
                $message .
                    " info:\n"
                    . $startTime
                    . " start batch\n"
                    . $endDate
                    . " end batch\n" .
                    "error:\n" .
                    $error
            );
        }
    }

    /**
     * write error
     *
     * @param  string $batchName
     * @param  string $message
     * @return void
     */
    public static function writeError($batchName, $message)
    {
        BatchLogger::wrapper($batchName, 'ERROR', $message);
    }

    /**
     * write warning
     *
     * @param  string $batchName
     * @param  string $message
     * @return void
     */
    public static function writeWarning($batchName, $message)
    {
        BatchLogger::wrapper($batchName, 'WARNING', $message);
    }

    /**
     * Write wa
     *
     * @param  string $batchName
     * @param  string $message
     * @return void
     */
    public static function writeInfo($batchName, $message)
    {
        BatchLogger::wrapper($batchName, 'INFO', $message);
    }
}
