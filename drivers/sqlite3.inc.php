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

use Exception;
use PDO;
use PDOException;

/**
 * Sqlite3 object
 */
final class Sqlite3 extends UsdcDriver
{
    private static ?PDO $_conn = null;

    /**
     * Intialize the database connection
     *
     * Use PHP constants to store database credentials
     *
     * define('FRAMEL_USDC_FILE', __DIR__ . '/../../../datas/framel.db');
     *
     * @return PDO A PDO connection or null
     */
    protected static function _initialize(): PDO
    {
        if (!defined('FRAMEL_USDC_FILE')) {
            define('FRAMEL_USDC_FILE', __DIR__ . '/../../../datas/framel.db');
        }

        try {
            // construct connection string
            $connectionString = sprintf(
                'sqlite:%s;charset=utf8',
                constant('FRAMEL_USDC_FILE'),
            );

            // return the MySQL PDO object
            $pdo = new PDO(
                $connectionString,
                '',
                '',
                [
                    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES      => false,
                    PDO::ATTR_STRINGIFY_FETCHES     => false,
                ]
            );

            // return the new PDO object
            return $pdo;
        } catch (PDOException $pdoe) {
            throw new Exception(sprintf(
                'SqLite3 PDO connection error: %s [%s | L %s]',
                $pdoe->getMessage(),
                $pdoe->getFile(),
                $pdoe->getLine(),
            ), $pdoe->getCode());
        }
    }
}
