<?php
	class Post{
		private $title;
		private $text;
		private $pub_date;
		private $id;
		//private $pdo;
		private $public;

		public function __construct($id = 0){
			if(is_numeric($id) && $id > 0){
				//load post data;
				$this->load($id);
			}
		}

		public function setTitle($title){
			if(trim($title) != ''){
				$this->title = $title;
			}else{
				echo 'Title is empty.';
			}
		}

		public function setText($text){
			if(trim($text) != ''){
				$this->text = $text;
			}else{
				echo 'Text is empty.';
			}
		}

		public function setPublic($public = 0){
			$this->public = $public;
		}

		public function getTitle(){
			return $this->title;
		}

		public function getText(){
			return $this->text;
		}

		public function getDate($format = ""){
			switch($format){
				case "date" :
					return preg_replace("/\s[0-9]+:[0-9]+:[0-9]+/", "", $this->pub_date);
				break;

				default:
					return $this->pub_date . "default";
			}

		}

		public function getPublic(){
			return $this->public;
		}

		private function load($id){
			//load post by id;
			require('login.php');
			if($id > 0){
				$query = 'SELECT title, text, public, pub_date FROM post WHERE id = :id';
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				if($stmt->execute()){
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					$this->title = $result['title'];
					$this->text = $result['text'];
					$this->pub_date = $result['pub_date'];
					$this->public = $result['public'];
					$this->id = $id;
					return $result;
				}
			}
		}

		public static function delete($id){
			if(is_numeric($id) && $id > 0){
				require('login.php');
				$query = 'DELETE FROM post WHERE id = :id';
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				if($stmt->execute()){
					echo "<p>Post(id:{$id}) deleted</p>";
				}else{
					echo "<p>Error deleting Post(id:{$id})</p>";
					var_dump($stmt->errorInfo());
				}
			}
		}

		public function save(){
			//save post data to database
			require('login.php');
			if($this->getTitle() && $this->getText()){
				if($this->id == 0){
					$query = 'INSERT INTO post(title, text, public) VALUES(:title, :text, :public)';

					$stmt = $pdo->prepare($query);
					$stmt->bindParam(':title', $this->getTitle(), PDO::PARAM_STR);
					$stmt->bindParam(':text', $this->getText(), PDO::PARAM_STR);
					$stmt->bindParam(':public', $this->public, PDO::PARAM_INT);
					if($stmt->execute()){
						//echo '<p>Post Added.</p>';
						return true;
					}else{
						//echo '<p>Error adding post. </p>';
						var_dump($stmt->errorInfo());
						return false;
					}
				unset($query);
				unset($stmt);

				}else{
					$query = 'UPDATE post SET title = :title, text = :text, public = :public, pub_date = NOW() WHERE id = :id';
					$stmt = $pdo->prepare($query);
					$stmt->bindParam(':title', $this->getTitle(), PDO::PARAM_STR);
					$stmt->bindParam(':text', $this->getText(), PDO::PARAM_STR);
					$stmt->bindParam(':public', $this->public, PDO::PARAM_INT);
					$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

					if($stmt->execute()){
						//echo "<p>Post(id:{$this->id}) Modified</p>";
						return true;
					}else{
						//echo "<p>Unable to save modifications on post(id:{$this->id})";
						return false;
						var_dump($stmt->errorInfo());
					}

					unset($query);
					unset($stmt);
				}
			}else{
				echo '<p>Title or Text is empty</p>';
			}
		}
	}
?>
