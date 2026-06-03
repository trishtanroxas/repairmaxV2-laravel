<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand as BaseServeCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends BaseServeCommand
{
    /**
     * Initialize the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // If PHP_CLI_SERVER_WORKERS is set and greater than 1, automatically force no-reload
        if ((int) env('PHP_CLI_SERVER_WORKERS', 1) > 1) {
            $input->setOption('no-reload', true);
        }

        parent::initialize($input, $output);
    }
}
