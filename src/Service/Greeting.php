<?php
/**
 * Created by PhpStorm.
 * user: raul
 * Date: 10/16/18
 * Time: 8:33 PM
 */

namespace App\Service;


use Psr\Log\LoggerInterface;

class Greeting
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function greet(string $name): string
    {
        $this->logger->info("Greeted $name");
        return "Hello $name";
    }
}