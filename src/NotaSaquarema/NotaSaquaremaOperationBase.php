<?php

namespace NotaSaquarema;

use NotaSaquarema\XmlInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

abstract class NotaSaquaremaOperationBase implements XmlInterface
{
    const BASE_ACTION_URL = 'https://saquarema.govbr.cloud/NFSe.Portal/';

    /**
     * @var array
     */
    protected $rps;

    /**
     * @var string
     */
    protected $env;

    /**
     * @var XmlEncoder
     */
    protected $encoder;

    public function __construct(string $env = 'dev', array $rps = [])
    {
        $this->rps = $rps;
        $this->env = $env;
        $this->encoder = new XmlEncoder();
    }

    /**
     * Sets rps array
     *
     * @param $rps
     */
    public function setRps(array $rps)
    {
        $this->rps = $rps;
    }

    /**
     * Sets env
     *
     * @param string $env
     */
    public function setEnv(string $env) {
        $this->env = $env;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnv(): string
    {
        return $this->env;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndpointUrl(): string
    {

        return "https://saquarema.govbr.cloud/NFSe.Portal/";
  
    }

    /**
     * {@inheritdoc}
     */
    public function getAction(): string
    {
        return self::BASE_ACTION_URL.$this->getOperation();
    }

    /**
     * Get XML encoder.
     *
     * @return XmlEncoder
     */
    public function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * Add SOAP envelope to XML.
     *
     * @param string $content
     * @return string
     */
    public function addEnvelope(string &$content)
    {
        $actionRequest = $this->getOperation().'Request';

        $env = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                <'.$actionRequest.' xmlns="https://saquarema.govbr.cloud/NFSe.Portal/">
                    <inputXML>
                    <![CDATA[
                        PLACEHOLDER
                    ]]>
                    </inputXML>
                </'.$actionRequest.'>
            </soap:Body>
        </soap:Envelope>';

        $content = str_replace('PLACEHOLDER', $content, $env);
    }
}
