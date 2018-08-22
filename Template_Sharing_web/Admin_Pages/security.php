<?php
class security extends database
{
    public function checkadmin()
    {
        if (isset($_SESSION["username"])&&($_SESSION['is_admin']==TRUE))
        {
            return TRUE;
        }
        else
            return FALSE;
    }
}
?>