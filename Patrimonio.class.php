<?php
	Class Patrimonio{

		function getDescriptions(){
			$query = "SELECT * FROM descricao";
			$run = mysqli_query($GLOBALS['conn'], $query);
			$i = 0;
			while ($row = mysqli_fetch_assoc($run)) {
				$data[$i] = $row;
				$i++;
			}

			return $data;
		}

		function getDescById($id){
			$query = "SELECT * FROM descricao WHERE id = '$id'";
			$run = mysqli_query($GLOBALS['conn'], $query);
			$row = mysqli_fetch_assoc($run);
			return $row['nome'];
		}
		function getEstById($id){
			switch ($id) {
				case 1:
					return "Funcionando";
					break;
				case 2:
					return "Quebrado";
					break;
				case 3:
					return "Em Manutenção";
					break;
				
				
			}
		}
	}