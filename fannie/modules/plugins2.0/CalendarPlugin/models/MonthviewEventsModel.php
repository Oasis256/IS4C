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

/**
  @class MonthviewEventsModel
*/
class MonthviewEventsModel extends BasicModel
{

    protected $name = "monthview_events";

    protected $columns = array(
    'eventID' => array('type'=>'INT', 'primary_key'=>true, 'increment'=>true),
    'calendarID' => array('type'=>'INT'),
    'eventDate' => array('type'=>'DATETIME'),
    'eventText' => array('type'=>'TEXT'),
    'uid' => array('type'=>'INT'),
	);

    /* START ACCESSOR FUNCTIONS */

    public function eventID()
    {
        if(func_num_args() == 0) {
            if(isset($this->instance["eventID"])) {
                return $this->instance["eventID"];
            } else if (isset($this->columns["eventID"]["default"])) {
                return $this->columns["eventID"]["default"];
            } else {
                return null;
            }
        } else {
            if (!isset($this->instance["eventID"]) || $this->instance["eventID"] != func_get_args(0)) {
                if (!isset($this->columns["eventID"]["ignore_updates"]) || $this->columns["eventID"]["ignore_updates"] == false) {
                    $this->record_changed = true;
                }
            }
            $this->instance["eventID"] = func_get_arg(0);
        }
    }

    public function calendarID()
    {
        if(func_num_args() == 0) {
            if(isset($this->instance["calendarID"])) {
                return $this->instance["calendarID"];
            } else if (isset($this->columns["calendarID"]["default"])) {
                return $this->columns["calendarID"]["default"];
            } else {
                return null;
            }
        } else {
            if (!isset($this->instance["calendarID"]) || $this->instance["calendarID"] != func_get_args(0)) {
                if (!isset($this->columns["calendarID"]["ignore_updates"]) || $this->columns["calendarID"]["ignore_updates"] == false) {
                    $this->record_changed = true;
                }
            }
            $this->instance["calendarID"] = func_get_arg(0);
        }
    }

    public function eventDate()
    {
        if(func_num_args() == 0) {
            if(isset($this->instance["eventDate"])) {
                return $this->instance["eventDate"];
            } else if (isset($this->columns["eventDate"]["default"])) {
                return $this->columns["eventDate"]["default"];
            } else {
                return null;
            }
        } else {
            if (!isset($this->instance["eventDate"]) || $this->instance["eventDate"] != func_get_args(0)) {
                if (!isset($this->columns["eventDate"]["ignore_updates"]) || $this->columns["eventDate"]["ignore_updates"] == false) {
                    $this->record_changed = true;
                }
            }
            $this->instance["eventDate"] = func_get_arg(0);
        }
    }

    public function eventText()
    {
        if(func_num_args() == 0) {
            if(isset($this->instance["eventText"])) {
                return $this->instance["eventText"];
            } else if (isset($this->columns["eventText"]["default"])) {
                return $this->columns["eventText"]["default"];
            } else {
                return null;
            }
        } else {
            if (!isset($this->instance["eventText"]) || $this->instance["eventText"] != func_get_args(0)) {
                if (!isset($this->columns["eventText"]["ignore_updates"]) || $this->columns["eventText"]["ignore_updates"] == false) {
                    $this->record_changed = true;
                }
            }
            $this->instance["eventText"] = func_get_arg(0);
        }
    }

    public function uid()
    {
        if(func_num_args() == 0) {
            if(isset($this->instance["uid"])) {
                return $this->instance["uid"];
            } else if (isset($this->columns["uid"]["default"])) {
                return $this->columns["uid"]["default"];
            } else {
                return null;
            }
        } else {
            if (!isset($this->instance["uid"]) || $this->instance["uid"] != func_get_args(0)) {
                if (!isset($this->columns["uid"]["ignore_updates"]) || $this->columns["uid"]["ignore_updates"] == false) {
                    $this->record_changed = true;
                }
            }
            $this->instance["uid"] = func_get_arg(0);
        }
    }
    /* END ACCESSOR FUNCTIONS */
}

