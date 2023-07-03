<?php

declare(strict_types=1);

namespace fastlogs\FastlogsBundle\EventListener;

use fastlogs\FastlogsBundle\Fastlogs;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ErrorListener
{
    private Fastlogs $fastlogs;

    /**
     * @param Fastlogs $fastlogs
     */
    public function __construct(Fastlogs $fastlogs)
    {
        $this->fastlogs = $fastlogs;
    }

    /**
     * @param ExceptionEvent $event
     * @return void
     */
    public function handleExceptionEvent(ExceptionEvent $event): void
    {
        $data = $this->export($event->getThrowable());

        $this->fastlogs->add($data);
    }

    public function export($message)
    {
        if ($message instanceof \Exception || $message instanceof \Throwable) {
            $data = [
                'message' => $message->getMessage(),
                'exception' => (string)$message,
            ];
        }else{
            $data['message'] = $message;
        }

        return $data;
    }
}
