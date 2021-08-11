<?php

namespace Volcengine\Kernel\Traits;

use Volcengine\Kernel\DataStructs\BaseResponse;
use Volcengine\Kernel\DataStructs\ErrorInfo;
use Volcengine\Kernel\DataStructs\ResponseMetadata;
use Volcengine\Kernel\Support\Collection;

trait ApiCastable
{
    public function baseResponse(Collection $collection)
    {
        return new BaseResponse(
            new ResponseMetadata(
                $collection->get('ResponseMetadata.RequestId'),
                $collection->get('ResponseMetadata.Action'),
                $collection->get('ResponseMetadata.Version'),
                $collection->get('ResponseMetadata.Service'),
                $collection->get('ResponseMetadata.Region'),
                $collection->has('ResponseMetadata.Error') ?
                new ErrorInfo(
                    $collection->get('ResponseMetadata.Error.CodeN'),
                    $collection->get('ResponseMetadata.Error.Code'),
                    $collection->get('ResponseMetadata.Error.Message')
                ) : null
            ),
            $collection->get('Result')
        );
    }
}
