<?php

namespace WiderFunnel\OptimizelyX\Adapters;

use WiderFunnel\OptimizelyX\Items\Experiment;

/**
 * Class VariationsAdapter
 * @package WiderFunnel
 */
class VariationsAdapter extends AdapterAbstract
{
    /**
     * @param array $variations
     * @return static
     */
    public function update(array $variations)
    {
        $response = $this->client->patch(
            "experiments/{$this->getResourceId()}",
            ["variations" => $variations]
        );

        return Experiment::createFromJson($response->getBody()->getContents());
    }
}