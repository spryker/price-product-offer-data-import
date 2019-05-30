<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SchedulerJenkins\Business\Executor;

use Generated\Shared\Transfer\SchedulerJenkinsResponseTransfer;
use Generated\Shared\Transfer\SchedulerJobTransfer;
use Spryker\Zed\SchedulerJenkins\Business\Api\JenkinsApiInterface;

class DisableExecutor implements ExecutorInterface
{
    protected const DISABLE_JOB_URL_TEMPLATE = 'job/%s/disable';

    /**
     * @var \Spryker\Zed\SchedulerJenkins\Business\Api\JenkinsApiInterface
     */
    protected $jenkinsApi;

    /**
     * @param \Spryker\Zed\SchedulerJenkins\Business\Api\JenkinsApiInterface $jenkinsApi
     */
    public function __construct(
        JenkinsApiInterface $jenkinsApi
    ) {
        $this->jenkinsApi = $jenkinsApi;
    }

    /**
     * @param string $idScheduler
     * @param \Generated\Shared\Transfer\SchedulerJobTransfer $jobTransfer
     *
     * @return \Generated\Shared\Transfer\SchedulerJenkinsResponseTransfer
     */
    public function execute(string $idScheduler, SchedulerJobTransfer $jobTransfer): SchedulerJenkinsResponseTransfer
    {
        return $this->jenkinsApi->executePostRequest(
            $idScheduler,
            sprintf(static::DISABLE_JOB_URL_TEMPLATE, $jobTransfer->getName())
        );
    }
}
