<?php

namespace Fssp;

use Fssp\Exception\FsspException;
use Fssp\Subject\SubjectInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Fssp
 * Документация по API https://api-ip.fssprus.ru/swagger
 * @package Fssp
 */
class Fssp extends Connect
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * @param $task
     * @return array
     * @throws GuzzleException
     */
    public function status($task): array
    {
        $this->method = '/status';
        $this->task = $task;
        return $this->get(['task' => $task]);
    }

    /**
     * @param $task
     * @return array
     * @throws GuzzleException
     */
    public function result($task): array
    {
        $this->method = '/result';
        $this->task = $task;
        return $this->get(['task' => $task]);
    }

    /**
     * @param SubjectInterface $fsspSubject
     * * @return array
     * @return array
     * @throws FsspException
     * @throws GuzzleException
     */
    public function search(SubjectInterface $fsspSubject): array
    {
        $this->method = '/search/';
        if (!$fsspSubject->isValid()) {
            throw new FsspException('Invalid subject');
        }
        $this->method .= $fsspSubject->code();
        return $this->get($fsspSubject->params());
    }

    /**
     * @param array SubjectInterface $fsspSubjects
     * @return array
     * @throws FsspException
     * @throws GuzzleException
     */
    public function searchGroup(array $fsspSubjects): array
    {
        $params = ['request' => []];
        foreach ($fsspSubjects as $fsspSubject) {
            if (!($fsspSubject instanceof SubjectInterface)) {
                throw new FsspException('Unknown subject');
            }
            if (!$fsspSubject->isValid()) {
                throw new FsspException('Invalid subject');
            }
            $params['request'][] = [
                'type' => $fsspSubject->type(),
                'params' => $fsspSubject->params(),
            ];
        }
        $this->method = '/search/group';
        return $this->post($params);
    }
}