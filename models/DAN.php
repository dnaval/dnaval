<?php
/* 
 * COMPANY: DNAVAL (2021)
 * Author: Daniel Naval
 * Description: DBController DAN Class
 */
class DAN{
    //DB Stuff
	private $conn;
        
    //Construct with DB
	public function __construct($db) {
		$this->conn = $db;
	}

    //Execute select statment and return the value
    public function runQuery($query) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $stmt->execute();

        //Get value from query
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result_item[] = $row;
        }
        if(!empty($result_item)) {
            return $result_item;
        }

    }
    
    //Execute INSERT and UPDATE Statement
    public function execQuery($query, $tab_arr) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $res = $stmt->execute($tab_arr);
        
        if($res) {
            $exec = 1;
        } else {
            $exec = 0;
        }
 
         return $exec;
    }
    
    public function execQueryOnly($query) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $res = $stmt->execute();
        
        if($res) {
            $exec = 1;
        } else {
            $exec = 0;
        }
 
         return $exec;
    }

    //Count the number of rows
    public function numRows($query) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $stmt->execute();

        //Get row count
        $nbr = $stmt->rowCount();

        return $nbr;
    }
     
    //Get Content info
    public function getContent() {
        $sql = "SELECT `twitter`, `facebook`, `instagram`, `skype`, `linkedin`, `title`, `about`, `skills`, `resume`, `portfolio` FROM `content`";

        $cont = $this->runQuery($sql);
        
        return $cont;
    }

     // Check if content info exist
     public function checkContent() {
        $query = "SELECT * FROM `content`";
    
        $nbc = $this->numRows($query);

        return $nbc;
    }

    //Put or Update content
    public function putContent($data_arr) {
        //Insert query
        $sqlin = "INSERT INTO `content`(`twitter`, `facebook`, `instagram`, `skype`, `linkedin`, `title`, `about`, `skills`, `resume`, `portfolio`) 
        VALUES (:twitter,:facebook,:instagram,:skype,:linkedin,:title,:about,:skills,:resume,:portfolio)";

        //Update query
        $sqlup = "UPDATE `content` 
        SET `twitter`=:twitter,`facebook`=:facebook,`instagram`=:instagram,`skype`=:skype,`linkedin`=:linkedin,`title`=:title,`about`=:about,`skills`=:skills,`resume`=:resume,`portfolio`=:portfolio 
        WHERE `idcontent`='1'";
        
        $chk = $this->checkContent();
        if($chk==1) {
           $res = $this->execQuery($sqlup, $data_arr);
        } else {
           $res = $this->execQuery($sqlin, $data_arr);
        }

       return $res;
   }
    
    // Check if skills info exist
    public function checkSkills($skills) {
        $query = "SELECT `idskills`, `skills`, `description`, `picture` FROM `skills` WHERE skills ='".$skills."'";
    
        $nbsk = $this->numRows($query);

        return $nbsk;
    }

    //Get skills ID
    public function getSkillsId($skills) {
        $query = "SELECT `idskills` FROM `skills` WHERE skills ='".$skills."'";
    
        $skid = $this->runQuery($query);

        foreach($skid as $val) {
            $ID = $val['idskills'];
        }

        return $ID;
    }

       //Get Skills info by id
    public function getSkillInfo($id) {
        $sql = "SELECT `idskills`, `skills`, `description`, `picture` FROM `skills` WHERE idskills ='".$id."'";

        $docs = $this->runQuery($sql);
        
        return $docs;
    }

    //Get Skills info
    public function getSkills() {
        $sql = "SELECT `idskills`, `skills`, `description`, `picture` FROM `skills`";

        $docs = $this->runQuery($sql);
        
        return $docs;
    }
    
    //Add new skills
    public function addSkills($data_arr) {
         //Insert query
         $sql = " INSERT INTO `skills`(`skills`, `description`, `picture`)"
         . "VALUES (:skills, :description, :picture)";

        //Prepare the query
        $res = $this->execQuery($sql, $data_arr);

	    return $res;
    }

    //Edit new skills
    public function editSkills($data_arr) {
        //Insert query
        $sql = " UPDATE `skills` 
        SET `skills`=:skills,`description`=:description,`picture`=:picture
        WHERE `idskills`=:idskills";

        //Prepare the query
        $res = $this->execQuery($sql, $data_arr);

        return $res;
    }

    //Delete skills
    public function deleteSkills($ID) {
        //Insert query
        $sql = " DELETE FROM `skills` WHERE `idskills`='".$ID."'";

        //Prepare the query
        $res = $this->execQueryOnly($sql);

        return $res;
    }

    public function getFilterType() {
        $sql = "SELECT `idtype`, `type`, `filter` FROM `type`";

        $ftyp = $this->runQuery($sql);
        
        return $ftyp;
    }

    //List projects
    public function listProjects() {
        $query = "SELECT p.idproject, p.project, p.description, p.category, p.company, p.projectdate, p.url, p.github, p.picture, p.gif, t.type , t.filter
        FROM `project` p
        INNER JOIN `type` t ON t.idtype = p.idtype";

        $lsprojs = $this->runQuery($query);
        
        return $lsprojs;
    }

    //Get projects
    public function getProject($idp) {
        $query = "SELECT  `idproject`, `project`, `description`, `category`, `company`, `projectdate`, `url`, `github`, `picture`, `gif`, `idtype` 
        FROM `project`
        WHERE idproject = '".$idp."'";

        $proj = $this->runQuery($query);
                
        return $proj;
    }

        //Add new project
        public function addProject($data_arr) {
        //Insert query
        $sql = "INSERT INTO `project`(`project`, `description`, `category`, `company`, `projectdate`, `url`, `github`, `picture`, `gif`, `idtype`) 
        VALUES (:project,:description,:category,:company,:projectdate,:url,:github,:picture,:gif,:idtype)";

        //Prepare the query
        $res = $this->execQuery($sql, $data_arr);

        return $res;
    }

    //Edit new project
    public function editProject($data_arr) {
        //Insert query
        $sql = "UPDATE `project` 
        SET `project`=:project,`description`=:description,`category`=:category,`company`=:company,`projectdate`=:projectdate,`url`=:url,`github`=:github,`picture`=:picture,`gif`=:gif,`idtype`=:idtype 
        WHERE `idproject`=:idproject";

        //Prepare the query
        $res = $this->execQuery($sql, $data_arr);

        return $res;
    }

    //Delete skills
    public function deleteProject($ID) {
        //Insert query
        $sql = " DELETE FROM `project` WHERE `idproject`='".$ID."'";

        //Prepare the query
        $res = $this->execQueryOnly($sql);

        return $res;
    }

    public function statUsers() {
        $query = "SELECT * FROM `users`";
    
        $nu = $this->numRows($query);

        return $nu;
    }

    public function statSkills() {
        $query = "SELECT * FROM `skills`";
    
        $ns = $this->numRows($query);

        return $ns;
    }

    public function statProject() {
        $query = "SELECT * FROM `project`";
    
        $np = $this->numRows($query);

        return $np;
    }

    //Get Type info for edit form
    public function getTypeInfo($id) {
        $sql = "SELECT `idtype`, `type`, `filter` FROM `type` WHERE idtype ='".$id."'";

        $docs = $this->runQuery($sql);
        
        return $docs;
    }
    
        //Get Type info
        public function getType() {
            $sql = "SELECT `idtype`, `type`, `filter` FROM `type`";
    
            $typ = $this->runQuery($sql);
            
            return $typ;
        }
        
        //Add new type
        public function addType($data_arr) {
             //Insert query
             $sql = "INSERT INTO `type`(`type`, `filter`) "
             . "VALUES (:type, :filter)";
    
            //Prepare the query
            $res = $this->execQuery($sql, $data_arr);
    
            return $res;
        }
    
        //Edit new type
        public function editType($data_arr) {
            //Insert query
            $sql = " UPDATE `type` 
            SET `type`=:type,`filter`=:filter
            WHERE `idtype`=:idtype";
    
            //Prepare the query
            $res = $this->execQuery($sql, $data_arr);
    
            return $res;
        }
    
        //Delete Type
        public function deleteType($ID) {
            //Insert query
            $sql = " DELETE FROM `type` WHERE `idtype`='".$ID."'";
    
            //Prepare the query
            $res = $this->execQueryOnly($sql);
    
            return $res;
        }
    
}
