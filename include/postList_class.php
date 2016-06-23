<?php

	class PostList{

		public static function getTitleList($limit = 0, $offset = 0){
			//return array with title and Id
			require('login.php');
			$query = "SELECT id, title FROM post";
			$query .= ($limit > 0) ? " LIMIT :limit" : '';
			$query .= ($offset > 0) ? " OFFSET :offset" : '';
			$query .= " ORDER BY pub_date DESC";
			$stmt = $pdo->prepare($query);
			if($limit > 0){
				$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
			}

			if($offset > 0){
				$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
			}

			if($stmt->execute()){
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$result = array();
				if(is_array($res)){
					foreach($res as $data){
						$result[$data["id"]] = $data['title'];
					}
					return $result;
				}
			}

		}

	}
?>
