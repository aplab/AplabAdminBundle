<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 15.08.2018
 * Time: 16:44
 */

namespace Aplab\AplabAdminBundle\Tools;

/**
 * Class Tools
 * @package Aplab\AplabAdminBundle\Tools
 */
class Tools
{
    /**
     * Являетс ли массив списком с числовыми ключами
     * Первый параметр массив для проверки
     * Второй параметр значит что ключи должны представлять собой
     * натуральный ряд чисел начинающийся с нуля и следующий по порядку
     *
     * @param array
     * @param bool $n0
     * @return boolean
     */
    public static function is_list(array $array, $n0 = true)
    {
        if (empty($array)) {
            return true;
        }
        $keys = join(array_keys($array));
        if (!ctype_digit($keys)) {
            return false;
        }
        if (!$n0) {
            return true;
        }
        return $keys === join(range(0, sizeof($array) - 1));
    }

    /**
     * Возвращает true, если $key может быть ключом массива.
     * В противном случае возвращает false.
     *
     * @param mixed $key
     * @return bool
     */
    public static function is_key($key)
    {
        try {
            $valid = array($key => null);
        } catch (\Throwable $exception) {
            return false;
        }
        if (empty($valid)) {
            return false;
        }
        return true;
    }

    /**
     * Join only nonempty string
     *
     * @param string $glue
     * @param array $pieces
     * @return string
     */
    public static function join_ne($glue, array $pieces)
    {
        return join($glue, array_filter($pieces));
    }
}