<?php
/*******************************************************************************

    Copyright 2014 Whole Foods Co-op

    This file is part of Fannie.

    IT CORE is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    IT CORE is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in the file license.txt along with IT CORE; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*********************************************************************************/

class FannieAutoComplete extends FannieWebService 
{
    
    public $type = 'json'; // json/plain by default

    /**
      Do whatever the service is supposed to do.
      Should override this.
      @param $args array of data
      @return an array of data
    */
    public function run($args)
    {
        global $FANNIE_OP_DB;
        $ret = array();
        if (!property_exists($args, 'field') || !property_exists($args, 'search')) {
            // missing required arguments
            $ret['error'] = array(
                'code' => -32602,
                'message' => 'Invalid parameters',
            );
            return $ret;
        } else if (strlen($args->search) < 2) {
            // search term is too short
            $ret['error'] = array(
                'code' => -32602,
                'message' => 'Invalid parameters',
            );
            return $ret;
        }

        $dbc = FannieDB::get($FANNIE_OP_DB);
        switch (strtolower($args->field)) {
            case 'item':
                $prep = $dbc->prepare('SELECT p.upc,
                                        p.description
                                       FROM products AS p
                                        LEFT JOIN productUser AS u ON u.upc=p.upc
                                       WHERE p.description LIKE ?
                                        OR p.brand LIKE ?
                                        OR u.description LIKE ?
                                        OR u.brand LIKE ?
                                       ORDER BY p.description');
                $term = '%' . $args->search . '%';
                $res = $dbc->execute($prep, array($term, $term, $term, $term));
                while ($row = $dbc->fetch_row($res)) {
                    $ret[] = array(
                        'label' => $row['description'],
                        'value' => $row['upc'],
                    );
                }

            case 'brand':
                $prep = $dbc->prepare('SELECT brand
                                       FROM products
                                       WHERE brand LIKE ?
                                       GROUP BY brand
                                       ORDER BY brand');
                $res = $dbc->execute($prep, array($args->search . '%'));
                while ($row = $dbc->fetch_row($res)) {
                    $ret[] = $row['brand'];
                }

                return $ret;

            case 'long_brand':
                $prep = $dbc->prepare('SELECT u.brand
                                       FROM productUser AS u
                                        INNER JOIN products AS p ON u.upc=p.upc
                                       WHERE u.brand LIKE ?
                                       GROUP BY u.brand
                                       ORDER BY u.brand');
                $res = $dbc->execute($prep, array($args->search . '%'));
                while ($row = $dbc->fetch_row($res)) {
                    $ret[] = $row['brand'];
                }

                return $ret;

            case 'vendor':
                $prep = $dbc->prepare('SELECT vendorID,
                                        vendorName
                                       FROM vendors
                                       WHERE vendorName LIKE ?
                                       ORDER BY vendorName');
                $res = $dbc->execute($prep, array($args->search . '%'));
                while ($row = $dbc->fetch_row($res)) {
                    $ret[] = $row['vendorName'];
                }

                return $ret;

            default:
                return $ret;
        }
    }
}

