<?php
include_once 'connectdb.php';

include 'mailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$crud = new crud($DB_con);
class crud
{
	private $conn;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($fname, $mname, $lname, $upass, $phone, $email, $type, $work, $addr, $sex, $dob, $marry, $currency) {
        try {
            
            $stmt = $this->db->prepare("INSERT INTO temp_account(fname,mname,lname,upass,phone,email,type,work,addr,sex,dob,marry,currency) 
			                                             VALUES(:fname, :mname, :lname, :upass, :phone, :email, :type, :work, :addr, :sex, :dob, :marry, :currency)");

            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":mname", $mname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":upass", $upass);
            $stmt->bindparam(":phone", $phone);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":type", $type);
            $stmt->bindparam(":work", $work);
            $stmt->bindparam(":addr", $addr);
            $stmt->bindparam(":sex", $sex);
            $stmt->bindparam(":dob", $dob);
            $stmt->bindparam(":marry", $marry);
            $stmt->bindparam(":currency", $currency);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
           
			return false;
        }
    }
    
    	public function createt($amount,$bank_name,$acc_name,$acc_no,$type,$swift,$routing,$remarks,$email,$status,$date) {
        try {
            
            $stmt = $this->db->prepare("INSERT INTO transfer(email,bank_name,acc_no,amount,date,status,swift,type,remarks,routing,acc_name) 
			                                             VALUES(:email, :bank_name, :acc_no, :amount, :date, :status, :type, :addr, :remarks, :routing :acc_name,)");

            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":bank_name",$bank_name);
            $stmt->bindparam(":acc_name",$acc_name);
            $stmt->bindparam(":acc_no",$acc_no);
            $stmt->bindparam(":amount",$amount);
            $stmt->bindparam(":date",$date);
            $stmt->bindparam(":status",$status);
            $stmt->bindparam(":swift",$swift);
            $stmt->bindparam(":type",$type);
            $stmt->bindparam(":remarks",$remarks);
            $stmt->bindparam(":routing",$routing);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
          echo $e->getMessage();
			return false;
        }
    }
	public function createg($fname,$lname,$email,$pin_auth,$pin,$atm)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO temp_account(fname,lname,email,pin_auth,pin,atm) VALUES(:fname, :lname, :email, :pin_auth, :pin , :atm )");
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":pin_auth",$pin_auth);
			$stmt->bindparam(":pin",$pin);
			$stmt->bindparam(":atm",$atm);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM account WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$acc_no,$fname,$lname,$email,$pin_auth,$pin,$uname,$phone,$type,$reg_date,$work,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$currency,$cot,$tax,$imf,$status,$phone_verify)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE account SET acc_no=:acc_no,
                                                       	fname=:fname,		
													   lname=:lname, 
													   email=:email,
													   pin_auth=:pin_auth,
													   pin=:pin,
													   uname=:uname,
													   phone=:phone,
                                                       type=:type,		
													   reg_date=:reg_date, 
													   work=:work,
													   addr=:addr,
													   sex=:sex,
													   dob=:dob,
													   marry=:marry,
                                                       t_bal=:t_bal,		
													   a_bal=:a_bal, 
													   currency=:currency,
													   cot=:cot,
													   tax=:tax,
													   imf=:imf,
													   status=:status,
													   phone_verify=:phone_verify
													   
													WHERE id=:id ");
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":pin_auth",$pin_auth);
			$stmt->bindparam(":pin",$pin);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":reg_date",$reg_date);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":imf",$imf);
			$stmt->bindparam(":status",$status);
			$stmt->bindparam(":phone_verify",$phone_verify);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
		public function updateb($id, $uname, $fname, $lname, $cot, $tax, $imf, $cot_status, $tax_status, $imf_status, $cot_msg, $tax_msg, $imf_msg)
{
    try
    {
        $stmt = $this->db->prepare("UPDATE account SET 
                                       uname = :uname,
                                       fname = :fname,
                                       lname = :lname,
                                       cot = :cot,
                                       tax = :tax,
                                       imf = :imf,
                                       cot_status = :cot_status,
                                       tax_status = :tax_status,
                                       imf_status = :imf_status,
                                       cot_msg = :cot_msg,
                                       tax_msg = :tax_msg,
                                       imf_msg = :imf_msg
                                   WHERE id = :id");

        $stmt->bindparam(":uname", $uname);
        $stmt->bindparam(":fname", $fname);
        $stmt->bindparam(":lname", $lname);
        $stmt->bindparam(":cot", $cot);
        $stmt->bindparam(":tax", $tax);
        $stmt->bindparam(":imf", $imf);
        $stmt->bindparam(":cot_status", $cot_status);
        $stmt->bindparam(":tax_status", $tax_status);
        $stmt->bindparam(":imf_status", $imf_status);
        $stmt->bindparam(":cot_msg", $cot_msg);
        $stmt->bindparam(":tax_msg", $tax_msg);
        $stmt->bindparam(":imf_msg", $imf_msg);
        $stmt->bindparam(":id", $id);

        $stmt->execute();
        return true;
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        return false;
    }
}

	
	
	
	
	
	
		public function getIDcard($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM virtual_card WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function updatecard($id,$card_no,$cvv,$exp,$card_status,$card_bal)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE virtual_card SET   card_no=:card_no,cvv=:cvv,exp=:exp,card_status=:card_status,card_bal=:card_bal WHERE id=:id ");
			$stmt->bindparam(":card_no",$card_no);
			$stmt->bindparam(":cvv",$cvv);
			$stmt->bindparam(":exp",$exp);
			$stmt->bindparam(":card_status",$card_status);
			$stmt->bindparam(":card_bal",$card_bal);
 
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	
	
	
	
	
	
	
	public function getIDloan($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM quick_loan WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function updateloan($id,$loanamt,$inter,$dura,$monthlypay,$balance,$status)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE quick_loan SET   loanamt=:loanamt,inter=:inter,dura=:dura,monthlypay=:monthlypay,balance=:balance,status=:status WHERE id=:id ");
			$stmt->bindparam(":loanamt",$loanamt);
			$stmt->bindparam(":inter",$inter);
			$stmt->bindparam(":dura",$dura);
			$stmt->bindparam(":monthlypay",$monthlypay);
			$stmt->bindparam(":balance",$balance);
			$stmt->bindparam(":status",$status);
 
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		
	
	
		public function getIDcrypto($ctid)
	{
		$stmt = $this->db->prepare("SELECT * FROM c_trans WHERE ctid=:ctid");
		$stmt->execute(array(":ctid"=>$ctid));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function updatecrypto($ctid,$status)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE c_trans SET  status=:status WHERE ctid=:ctid ");
		 
			$stmt->bindparam(":status",$status);
 
			$stmt->bindparam(":ctid",$ctid);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		
	
	
	
	
	
		public function getIDwallet($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM account WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function updatewallet($id,$btc_w,$btc_bal,$ethe_w,$ethe_bal,$usdt_w,$usdt_bal,$litecoin_w,$litecoin_bal)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE account SET   btc_w=:btc_w,btc_bal=:btc_bal,ethe_w=:ethe_w,ethe_bal=:ethe_bal,usdt_w=:usdt_w,usdt_bal=:usdt_bal,litecoin_w=:litecoin_w,litecoin_bal=:litecoin_bal WHERE id=:id ");
		 
			$stmt->bindparam(":btc_w",$btc_w);
            $stmt->bindparam(":btc_bal",$btc_bal);
            $stmt->bindparam(":ethe_w",$ethe_w);
            $stmt->bindparam(":ethe_bal",$ethe_bal);
            $stmt->bindparam(":usdt_w",$usdt_w);
            $stmt->bindparam(":usdt_bal",$usdt_bal);
            $stmt->bindparam(":litecoin_w",$litecoin_w);
            $stmt->bindparam(":litecoin_bal",$litecoin_bal);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
		
		
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		public function getIDcr($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM alerts WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function updatecrg($id,$uname,$amount,$remarks,$type,$date,$time)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE alerts SET email=:email,
                                                       	bank_name=:bank_name,		
													   acc_name=:acc_name, 
													   acc_no=:acc_no,
													   amount=:amount,
													   date=:date,
													   status=:status,
													   swift=:swift,
                                                       type=:type,		
													   remarks=:remarks
													   
													WHERE id=:id ");
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":status",$status);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":remarks",$remarks);
			
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function updatecr($id,$uname,$amount,$remarks,$type,$date,$time,$statz)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE alerts SET uname=:uname,
                                                       	amount=:amount,		
													   remarks=:remarks, 
													   type=:type,
													   date=:date,
													   time=:time,
													   statz=:statz
													   
													   
													WHERE id=:id ");
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":time",$time);
			$stmt->bindparam(":statz",$statz);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function updateapprove($id,$acc_no,$fname,$lname,$email,$pin_auth,$pin,$uname,$phone,$reg_date,$verify,$addr,$dob,$marry,$t_bal,$a_bal,$currency,$cot,$tax,$imf,$status,$phone_verify)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE account SET acc_no=:acc_no,
                                                       	fname=:fname,		
													   lname=:lname, 
													   email=:email,
													   pin_auth=:pin_auth,
													   pin=:pin,
													   uname=:uname,
													   phone=:phone,		
													   reg_date=:reg_date,
													   addr=:addr,
													   dob=:dob,
													   marry=:marry,
                                                       t_bal=:t_bal,		
													   a_bal=:a_bal, 
													   currency=:currency,
													   cot=:cot,
													   tax=:tax,
													   imf=:imf,
													   status=:status,
													   phone_verify=:phone_verify, 
													   verify=:verify
													   
													   
													   
													   
													WHERE id=:id ");
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":pin_auth",$pin_auth);
			$stmt->bindparam(":pin",$pin);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":reg_date",$reg_date);
			$stmt->bindparam(":verify",$verify);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":imf",$imf);
			$stmt->bindparam(":status",$status);
			$stmt->bindparam(":phone_verify",$phone_verify);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

public function updatet($id,$email,$bank_name,$acc_name,$acc_no,$amount,$date,$status,$swift,$type,$remarks)
	{
		try
		{
		
			$stmt=$this->db->prepare("UPDATE transfer SET email=:email,
                                                       	bank_name=:bank_name,		
													   acc_name=:acc_name, 
													   acc_no=:acc_no,
													   amount=:amount,
													   date=:date,
													   status=:status,
													   swift=:swift,
                                                       type=:type,		
													   remarks=:remarks
													   
													WHERE id=:id ");
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":status",$status);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":remarks",$remarks);
			
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function deletet($id)
	{
		$stmt = $this->db->prepare("DELETE FROM transfer WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	public function deletecr($id)
	{
		$stmt = $this->db->prepare("DELETE FROM alerts WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function dataviewt($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
				<td><?php print($row['email']); ?></td>
                <td><?php print($row['bank_name']); ?></td>
                
                <td><?php print($row['transtype']); ?></td>
                <td><?php print($row['cout']); ?></td>
                <td><?php print($row['acc_name']); ?></td>
                <td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['amount']); ?></td>
				<td><?php print($row['date']); ?></td>
				<td><?php print($row['status']); ?></td>
                <td align="center">
                <a class="btn btn-sm btn-success"  href="edit-transfer.php?edit_id=<?php print($row['id']); ?>">EDIT</a>
                </td>
                
				<td align="center">
                <a class="btn btn-sm btn-danger"  href="delete-transfer.php?delete_id=<?php print($row['id']); ?>">DEL</a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
		public function dataviewcr($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
				<td><?php print($row['uname']); ?></td>
                <td><?php print($row['amount']); ?></td>
                
                <td><?php print($row['remarks']); ?></td>
                <td><?php print($row['type']); ?></td>
                <td><?php print($row['statz']); ?></td>
                <td><?php print($row['date']); ?></td>
                <td><?php print($row['time']); ?></td>
                
                <td align="center">
                <a class="btn btn-success"  href="e.php?edit_id=<?php print($row['id']); ?>">EDIT</a>
                </td>
                
				<td align="center">
                <a class="btn btn-danger" href="dcr.php?delete_id=<?php print($row['id']); ?>">DEL</a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
 
 	public function getIDt($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM transfer WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM account WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['fname']); ?></td>
                <td><?php print($row['lname']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['pin_auth']); ?></td>
				<td><?php print($row['pin']); ?></td>
				<td><?php print($row['uname']); ?></td>
                <td align="center">
                <a class="btn btn-sm btn-success"  href="edit-customer.php?edit_id=<?php print($row['id']); ?>">EDIT</a>
                </td>
                
				<td align="center">
                <a class="btn btn-sm btn-danger"  href="delete-customer.php?delete_id=<?php print($row['id']); ?>">DEL</a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	/* paging */
	
	public function billingview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['uname']); ?></td>
				<td><?php print($row['fname']); ?></td>
                <td><?php print($row['lname']); ?></td>
                <td><?php print($row['imf']); ?></td>
                <td><?php print($row['cot']); ?></td>
                <td><?php print($row['tax']); ?></td>
                <td align="center">
                <a class="btn btn-sm btn-success"  href="edit-billing.php?edit_id=<?php print($row['id']); ?>">EDIT</a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	
	
	
		public function dataviewcard($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
             
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['name']); ?>/<?php print($row['email']); ?></td>
                <td><?php print($row['card_no']); ?></td>
                <td><?php print($row['cvv']); ?></td>
                <td><?php print($row['exp']); ?></td>
				<td><?php print($row['card_status']); ?></td>
				<td><?php print($row['card_bal']); ?></td>
				<td><?php print($row['card_type']); ?></td>
				<td><?php print($row['card_date']); ?></td>
                <td align="center">
                <a class="btn btn-sm btn-success"  href="edit-card.php?edit_id=<?php print($row['id']); ?>">Edit</a>
                </td>
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	
	
	
	
	
	
		public function dataviewloan($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
             
				 
                <td><?php print($row['name']); ?>/<?php print($row['email']); ?></td>
                <td><?php print($row['loanamt']); ?></td>
                <td><?php print($row['inter']); ?></td>
                <td><?php print($row['dura']); ?></td>
				<td><?php print($row['monthlypay']); ?></td>
				<td><?php print($row['balance']); ?></td>
				<td><?php print($row['status']); ?></td>
				<td><?php print($row['date']); ?></td> 
                <td align="center">
                <a class="btn btn-sm btn-success"  href="edit-loan.php?edit_id=<?php print($row['id']); ?>">EDIT</a>
                </td>
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	
	
	
	
	
	
public function dataviewcrypto($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr> 
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['sw']); ?></td>
				<td><?php print($row['rw']); ?></td>
				<td><?php print($row['ctype']); ?></td>
				
                <td><?php print($row['amt']); ?></td>
                <td><?php print($row['ref']); ?></td>
                <td><?php print($row['date']); ?></td>
				<td><?php print($row['status']); ?></td>
				 
                <td align="center">
                <a class="btn btn-success"  href="edit-crypto.php?edit_ctid=<?php print($row['ctid']); ?>">APPROVE</a>
                <a class="btn btn-danger"  href="delete-crypto.php?ctid=<?php print($row['ctid']); ?>">DEL</a>
                </td>
                
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		public function dataviewwallet($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
             
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['btc_w']); ?></td>
                <td><?php print($row['btc_bal']); ?></td>
                <td><?php print($row['ethe_w']); ?></td>
				<td><?php print($row['ethe_bal']); ?></td>
				<td><?php print($row['usdt_w']); ?></td>
				<td><?php print($row['usdt_bal']); ?></td>
				<td><?php print($row['litecoin_w']); ?></td> 
				<td><?php print($row['litecoin_bal']); ?></td>
                <td align="center">
                <a class="btn btn-success"  href="topup-crypto.php?edit_id=<?php print($row['id']); ?>">TOPUP</a>
                </td>
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

		public function dataviewsecurity($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
             
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['ans1']); ?></td>
                <td><?php print($row['ans2']); ?></td>
				<td><?php print($row['sdate']); ?></td> 
                <td align="center">
                <a class="btn btn-success"  href="#">EDIT</a>
                </td>
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}	
	
	
	
	
	
	
	
		public function dataviewbeneficiary($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
             
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['racc']); ?></td>
				<td><?php print($row['rbank']); ?></td> 
				<td><?php print($row['rname']); ?></td>
				<td><?php print($row['remail']); ?></td> 
				<td><?php print($row['rswift']); ?></td> 
				<td><?php print($row['iban']); ?></td> 
				<td><?php print($row['baddress']); ?></td> 
				<td><?php print($row['rcurrency']); ?></td> 
				<td><?php print($row['bdate']); ?></td> 
				<td><?php print($row['rtype']); ?></td> 
				<td><?php print($row['rcountry']); ?></td> 
                <td align="center">
                <a class="btn btn-success"  href="#">EDIT</a>
                </td>
             
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function dataviewapprove($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['id']); ?></td>
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['fname']); ?></td>
                <td><?php print($row['lname']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['pin_auth']); ?></td>
				<td><?php print($row['pin']); ?></td>
				<td><?php print($row['uname']); ?></td>
                <td align="center">
                <a class="btn btn-success" href="approveuser.php?edit_id=<?php print($row['id']); ?>">APPROVE</a>
                </td>
                
				<td align="center">
                <a  vclass="btn btn-danger" href="approveuser.php?delete_id=<?php print($row['id']); ?>">DEL</a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a style='color:#000;' href='".$self."?page_no=1'>First</a></li>&nbsp;&nbsp;";
				echo "<li><a style='color:#000;' href='".$self."?page_no=".$previous."'>Prev</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' class='btn-primary' style='color:white;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a style='color:#000;' href='".$self."?page_no=".$next."'>Next</a></li>&nbsp;&nbsp;";
				echo "<li><a style='color:#000;' href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
    
    function send_mail($email, $message, $subject) {
        require_once "mailer/PHPMailer.php";
        require_once "mailer/SMTP.php";
        require_once "mailer/Exception.php";
        
        $mail = new PHPMailer();
        //SMTP Settings (use default cpanel email account)
        $mail->isSMTP();
        $mail->Host = "karamelhub.com.ng"; //
        $mail->SMTPAuth = true;
        $mail->Username = "mail@karamelhub.com.ng"; // Default cpanel email account
        $mail->Password = '@@mailpass##'; // Default cpanel email password
        $mail->Port = 465; // 587
        $mail->SMTPSecure = "ssl"; // tls
    
        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('mail@karamelhub.com.ng','SkyLark'); // Email address/ Bank bane shown to reciever
        $mail->addAddress($email);
        $mail->AddReplyTo("mail@karamelhub.com.ng", "SkyLark"); // Email address/ Bank bane shown to reciever
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $send = $mail->Send();
        return $send;
    }
    
}