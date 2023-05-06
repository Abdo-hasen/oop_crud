<?php


        // try and catch result templete

        // {
            // try
            // {

            // }
            // catch(Exception $e)
            // {
            //     die("Delete query failed : " . $e->getMessage());
            // }
        // }

    class Database 
    {
        // database information
        const HOSTNAME = "localhost";
        const USERNAME = "root";
        const PASSWORD = "";
        const DATABASE= "company";

        //helper properties
        private $mysqli; 
        private $table;
        private $addedSuccess = "addedd successfully";
        private $updatedSuccess = "updated successfully";
        private $deletedSuccess = "deleted successfully";

        


        public function __construct()
        {
            try
            {

                $this->mysqli = new mysqli(self::HOSTNAME, self::USERNAME, self::PASSWORD, self::DATABASE);
               

            }catch(Exception $e)
            {
                die("connection failed: " . $e->getMessage());
            }
        
        }

    
        // take table of db

        public function table($table)
        {
            $this->table = $table;
            return $this;
        }

        // insert data in db

        public function insert($data)
        {
        
            $names = ""; // key : ex->name
            $values = ""; // value : ex->ahmed
            foreach($data as $key => $value){ 
                $names .= "`$key`,"; // like in query - comma for multible data
                $values .= "'$value',"; //  .= : to add or conctante data
            }

            $names = substr($names,0,-1); // to remove comma in the end of keys or value before insert in query
            $values = substr($values,0,-1);

        
            $query = " INSERT INTO `$this->table` ($names) VALUES ($values) ";
            $result = $this->mysqli->query($query);

            if($result) //to check on query success or fail
            {
                return $this->addedSuccess;
            }else{
                die("error : " . $this->mysqli->error);
            }
        }


        // read data from db

        public function read($table)
        {

            try
            {
                $query = " SELECT * FROM `$table` ";
                $result = $this->mysqli->query($query);
                $data = [];
                if($result)
                {
                    try
                    {

                        if($result->num_rows) // to check if found data or not
                        {  
                            while($row = $result->fetch_assoc())
                            {
                                $data[] = $row;
                            }
                        }

                        return $data;
                        $result->free();  // free memory from  result set 

                    }
                    catch(Exception $e)
                    {
                        die("Error : " . $e->getMessage());
                    }
                  
                }

            }
            catch(Exception $e)
            {
                die("Error : " . $e->getMessage());
            }
          
        
        }

       
        // update data in db 

        // public function update($data,$id)
        // {

        //      try
        //     {
       
        //         $names = ""; // key : ex->name
        //         $values = ""; // value : ex->ahmed
        //         foreach($data as $key => $value){ 
        //             $names .= "`$key`,"; // like in query - comma for multible data
        //             $values .= "'$value',"; //  .= : to add or conctante data
        //         }

        //         $names = substr($names,0,-1); // to remove comma in the end of keys or value before insert in query
        //         $values = substr($values,0,-1);

            
        //         $query = " UPDATE `$this->table` SET $key = $value WHERE `id` = '$id' ";
        //         $result = $this->mysqli->query($query);

        //         if($result)
        //         {
        //             return "Updated successfully";
        //         }

        //     }
        //     catch(Exception $e)
        //     {
        //         die("Error : " . $e->getMessage());
        //     }
          
        // }

        public function update($query)
        {
            $result = $this->mysqli->query($query);
            if($result)
            {
                return $this->updatedSuccess;
            }
            else
            {
                die("error : " . $this->mysqli->error);
            }
        }


        // delete data in db 

        public function delete($table, $id)
        {
          
            try
            {

                $query = "DELETE FROM `$table` WHERE `id`='$id'";
                $result = $this->mysqli->query($query);
                if ($result)
                {
                    return $this->deletedSuccess;
                    
                }

            }
            catch(Exception $e)
            {
                die("Delete query failed : " . $e->getMessage());
            }
                 
        }

       
             
        // find id in db - get data of specefic item 

        public function find($table,$id)
        {
            $query = " SELECT * FROM `$table` WHERE `id` = '$id' ";
            $result = $this->mysqli->query($query);

            if($result)
            {
                if($result->num_rows)
                {
                    return $result->fetch_assoc();
                }

                return false;
            }
            else
            {
                die("error : " . $this->mysqli->error);
            }
        }

        // fn to encrypt

        public function encPassword($password)
        {
            return password_hash($password,PASSWORD_DEFAULT);
        }

        

        // close connection

        public function __destruct()
        {
            $this->mysqli->close();
        }



    }



 