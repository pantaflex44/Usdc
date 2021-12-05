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

/**
 * Mysql object
 */
class UsdcDriver implements IDb
{

    private static ?PDO $_conn = null;

    /**
     * Get the database connection
     *
     * @return PDO The database connection
     */
    public static function connection(): PDO
    {
        $driver = constant('FRAMEL_USDC_ENGINE');
        $ns = __NAMESPACE__ . '\\' . ucfirst(strtolower($driver));

        if (is_null(self::$_conn)) {
            // the first connection
            self::$_conn = $ns::_initialize();
        } else {
            // else, if has a memorized connection
            // if not, disable error_reporting
            $oldErrLvl = error_reporting(0);

            try {
                // try the connection with a blank query
                self::$_conn->query("SELECT 1");
            } catch (\PDOException $pdoe) {
                // if not a valid connection, try to reload
                self::$_conn = $ns::_initialize();
            }

            // rollback error_reporting status
            error_reporting($oldErrLvl);
        }

        return self::$_conn;
    }
}
