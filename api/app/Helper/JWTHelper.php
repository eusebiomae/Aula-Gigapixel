<?php

use Illuminate\Support\Facades\Crypt;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\Algorithm\HS512;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\Serializer\JWSSerializerManager;

class JWTHelper
{

	private $algorithmManager = null;
	private $jwk = null;
	private $jws = null;
	private $gpToken = '';

	public function __construct()
	{
		$this->algorithmManager = new AlgorithmManager([
			new HS512(),
		]);

		$this->jwk = new JWK([
			'kty' => 'oct',
			'k' => config('app.jwtKey'),
		]);
	}

	public function setGPToken($gpToken) {
		$this->gpToken = $gpToken;
		$this->setJWS();

		return $this;
	}

	public function build($dataPayload)
	{
		$time = time();

		$payload = json_encode([
			'iat' => $time,
			'nbf' => $time,
			'exp' => $time + 3600,
			'payload' => $dataPayload,
		]);

		$jws = (new JWSBuilder($this->algorithmManager))->create()->addSignature($this->jwk, ['alg' => 'HS512'])->withPayload($payload)->build();

		return Crypt::encrypt((new CompactSerializer())->serialize($jws, 0));
	}

	public function getPayload()
	{
		return json_decode($this->jws->getPayload())->payload;
	}

	public function isValid() {
		return (new JWSVerifier($this->algorithmManager))->verifyWithKey($this->jws, $this->jwk, 0);
	}

	public static function getOctKey()
	{
		return JWKFactory::createOctKey(2048, ['alg' => 'PS512', 'use' => 'sig']);
	}

	private function setJWS() {
		try {
			$serializerManager = new JWSSerializerManager([ new CompactSerializer() ]);

			$decrypted = Crypt::decrypt($this->gpToken);

			$this->jws = $serializerManager->unserialize($decrypted);

			return $this;
		} catch (\Throwable $e) {
			throw new Exception("{$e->getMessage()} \n Line: {$e->getLine()} \nFiles {$e->getFile()} \nCode {$e->getCode()}");
		}
	}
}
