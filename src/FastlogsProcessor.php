<?php

namespace fastlogs\FastlogsBundle;

class FastlogsProcessor
{
    private Fastlogs $fastlogs;
    private $channels;
    private $level;

    private $levels = [
        100 => 'DEBUG',
        200 => 'INFO',
        250 => 'NOTICE',
        300 => 'WARNING',
        400 => 'ERROR',
        500 => 'CRITICAL',
        550 => 'ALERT',
        600 => 'EMERGENCY',
    ];

    /**
     * @param Fastlogs $fastlogs
     */
    public function __construct(Fastlogs $fastlogs, $channels, $level)
    {
        $this->fastlogs = $fastlogs;
        $this->channels = $channels;
        $this->level = strtoupper($level);
    }

    public function checkLevels($levelSelect): bool
    {
        $levels = [];
        $bool = false;
        foreach ($this->levels as $keyLevel => $level) {
            if ($this->level == $level || $bool) {
                $bool = true;
                $levels[$keyLevel] = $level;
            }
        }

        if (in_array($levelSelect, $levels)) {
            return false;
        }
        return true;
    }

    public function checkChannel($channelThis): bool
    {
        $channelSelect = [];
        $channelNoSelect = [];
        foreach ($this->channels as $channel) {
            if ($channel[0] == '!') {
                $channelNoSelect[] = substr($channel, 1);
            }else{
                $channelSelect[] = $channel;
            }
        }

        if (in_array($channelThis, $channelNoSelect)) {
            return true;
        }

        if (empty($channelSelect)){
            return false;
        }else{
            if (in_array($channelThis, $channelSelect)) {
                return false;
            }
            return true;
        }

    }


    public function processRecord(array $record)
    {
        if ($this->checkLevels($record['level_name'])) {
            return $record;
        }

        if ($this->checkChannel($record['channel'])){
            return $record;
        }
        dump($record);

        foreach ($record['context'] as &$context) {
            $context = (string)$context;
        }
        $data = [
            'message' => $record['message'],
            'level_name' => $record['level_name'],
            'channel' => $record['channel'],
            'context' => $record['context']
        ];
        $this->fastlogs->add($data);

        return $record;
    }
}