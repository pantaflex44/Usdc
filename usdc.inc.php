<?php

/**
 * @Usdc - Universal Sql Database Connector
 * 
 * MIT License
 * 
 * Copyright (C) 2021 Christophe LEMOINE 
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Framel\Libs\Usdc;

use PDO;
use ReflectionClass;

/**
 * Database object
 */
class Usdc
{

    /**
     * Get a database instance
     * 
     * Use constants to define the database engine:
     * 
     * define('FRAMEL_USDC_ENGINE', 'mysql');
     *
     * @param string $driver
     * @return IDb|null
     */
    public static function get(): ?IDb
    {
        if (!defined('FRAMEL_USDC_ENGINE')) define('FRAMEL_USDC_ENGINE', 'mysql');

        $driver = constant('FRAMEL_USDC_ENGINE');

        $filepath = __DIR__ . '/drivers/' . $driver . '.inc.php';
        if (!file_exists($filepath)) {
            return null;
        }

        $ns = __NAMESPACE__ . '\\' . ucfirst(strtolower($driver));

        $rc = new ReflectionClass($ns);
        return $rc->newInstanceWithoutConstructor();
    }
}

/**
 * Database interface
 */
interface IDb
{
    public static function connection(): PDO;
}
