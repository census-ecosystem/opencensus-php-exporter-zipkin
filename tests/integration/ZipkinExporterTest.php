<?php
/**
 * Copyright 2018 OpenCensus Authors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace OpenCensus\Tests\Integration\Trace\Exporter;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ZipkinExporterTest extends TestCase
{
    private static $zipkinClient;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $zipkinHost = getenv('ZIPKIN_HOST') ?: 'localhost';
        $zipkinPort = (int)(getenv('ZIPKIN_PORT') ?: 9411);
        self::$zipkinClient = new Client([
            'base_uri' => sprintf('http://%s:%d/', $zipkinHost, $zipkinPort)
        ]);
    }

    public function testReportsTraceToZipkin()
    {
        $rand = mt_rand();
        $client = new Client(['base_uri' => 'http://localhost:9000']);
        $response = $client->request('GET', '/', [
            'query' => [
                'rand' => $rand
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello world!', $response->getBody()->getContents());

        $response = $this->findTraces($rand);
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody()->getContents(), true);
        $this->assertCount(1, $data);
        $trace = $data[0];
        $this->assertCount(2, $trace);
        $rootSpan = $trace[0];
        $this->assertEquals('SERVER', $rootSpan['kind']);
        $this->assertArrayHasKey('localEndpoint', $rootSpan);
        $this->assertArrayHasKey('ipv4', $rootSpan['localEndpoint']);
        $this->assertArrayHasKey('tags', $rootSpan);
        $this->assertEquals('bar', $rootSpan['tags']['foo']);
    }

    public function testCanReachZipkinServer()
    {
        $response = self::$zipkinClient->request('GET', '/zipkin/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    private function findTraces($rand)
    {
        return self::$zipkinClient->request('GET', '/api/v2/traces', [
            'query' => [
                'spanName' => "/?rand=$rand"
            ]
        ]);
    }
}
