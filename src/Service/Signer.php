<?php

namespace Signer\Service;

use Signer\Service\Exceptions\HashingFailedException;

class Signer
{
    /**
     * @var int
     */
    protected $cost = 10;

    /**
     * @var string
     */
    protected $passphrase = '';

    /**
     * RequestSigner constructor.
     *
     * @param int $cost
     * @param string $passphrase
     */
    public function __construct(int $cost, string $passphrase)
    {
        $this->cost       = $cost;
        $this->passphrase = $passphrase;
    }

    /**
     * Sort an array.
     *
     * @param array $data
     * @return array
     */
    protected function sort(array $data): array
    {
        ksort($data);

        foreach ($data as &$value) {
            $value = is_array($value) ? $this->sort($value) : $value;
        }

        return $data;
    }

    /**
     * Convert the data to a string for hashing.
     *
     * @param array|string $data
     * @return string
     */
    protected function stringify($data): string
    {
        $data = $this->sort($data);
        $data = json_encode($data);

        return $data;
    }

    /**
     * Generate signature.
     *
     * @param array $data
     * @return string
     * @throws HashingFailedException
     */
    public function sign(array $data): string
    {
        $data = $this->stringify($data);

        $hash = password_hash($data, PASSWORD_BCRYPT, [
            'cost' => $this->cost,
        ]);

        if ($hash === false) {
            throw new HashingFailedException('Hashing the data failed');
        }

        return $hash;
    }

    /**
     * Check the signature.
     *
     * @param array $data
     * @param string $hash
     * @return bool
     */
    public function verify(array $data, string $hash): bool
    {
        $data = $this->stringify($data);

        return password_verify($data, $hash);
    }
}
