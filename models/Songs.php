<?php

namespace test\models;

/**
 * @brief	Songs' class model
 */
class Songs extends AbstractModel
{
	/**
	 * @brief	Getting all data with SQL query.
	 *
	 * @return	array
	 */
	public function selectAll(): array
	{
		return $this->db->get( 'Songs' )->result_array();
	}

	/**
	 * @brief	Getting data with SQL query by id.
	 *
	 * @param	string $id
	 *
	 * @details	As MySQL query: " SELECT * FROM Songs WHERE ID = " . $id .";";
	 *
	 * @return	array
	 */
	public function selectById( $id ): array
	{
		return $this->db->where( 'ID', $id )->get( 'Songs' )->result_array();
	}

	/**
	 * @brief	Inserting a new row with SQL query.
	 *
	 * @param	string $name
	 * @param	int $year
	 * @param	int $authorId
	 *
	 * @return	string
	 */
	public function insertSong( string $name, int $year, int $authorId ): string
	{
		$data	= array(
			'name'		=> $name,
			'year'		=> $year,
			'authorID'	=> $authorId
		);

		$sql	= $this->db->insert( 'Songs', $data );

		if ( $sql === true )
		{
			return "Song inserted successfully with ID: " . $this->db->insert_id() . "!";
		}
		else
		{
			return "Error: " . $sql . " | " . $sql->error;
		}
	}

	/**
	 * @brief	Getting all data with SQL query.
	 *
	 * @param	int $id
	 * @param	string $name
	 * @param	int $year
	 * @param	string $author
	 *
	 * @return	string
	 */
	public function editSong( int $id, string $name, int $year, int $authorId ): string
	{
		$data	= array(
			'name'		=> $name,
			'year'		=> $year,
			'authorID'	=> $authorId
		);

		$sql	= $this->db->where( 'ID', $id )->update( 'Songs', $data );

		if ( $sql === true )
		{
			return "Song edited successfully with ID:" . $id . "!";
		}
		else
		{
			return "Error: " . $sql . " | " . $sql->error;
		}
	}

	/**
	 * @brief	Getting all data with SQL query.
	 *
	 * @param	int $id
	 *
	 * @details	As SQL query: " DELETE FROM Songs WHERE ID=" . $id . ";"
	 *
	 * @return	string
	 */
	public function deleteSong( int $id ): string
	{
		$sql	= $this->db->where( 'ID' , $id )->delete( 'Songs' );

		if ( $sql === true )
		{
			return "Song deleted successfully!";
		}
		else
		{
			return "Error: " . $sql . " | " . $sql->error;
		}
	}

	/**
	 * @brief	Pager for child models.
	 *
	 * @param	int $currentPage
	 * @param	int $length
	 *
	 * @return	array
	 */
	public function pagedSelect( int $currentPage, int $length ): array
	{
		$start	= ( $currentPage * $length ) - $length;

		return $this->db->query('	SELECT s.ID, s.name, s.year, CONCAT(a.firstname,\' \',a.lastname) AS authorname
									FROM Songs as s 
									INNER JOIN Authors as a ON s.authorID = a.ID 
									LIMIT '. $length .' 
									OFFSET '. $start )->result_array();
	}

	/**
	 * @brief	Pager for child models.
	 *
	 * @param	int $length
	 *
	 * @return	int
	 */
	public function pagesCount( int $length ): int
	{
		$result		= $this->db->get('Songs', $length, 0)->result_array();

		$countAll	= $this->db->select( 'COUNT(ID)' )->get( 'Songs' )->result_array();

		return intval( ceil( $countAll[0]['COUNT(ID)'] / count( $result ) ) );
	}

	/**
	 * @brief	Pager for child models.
	 *
	 * @param	string $name
	 * @param	int $year
	 * @param	int $authorId
	 *
	 * @return	array
	 */
	public function filteredSelect( string $name, int $year, int $authorId ): array
	{
		return $this->db
			->where( 'name', $name )
			->or_where( 'year', $year )
			->or_where( 'authorID', $authorId )
			->select( 's.ID, s.name, s.year, CONCAT(a.firstname,\' \',a.lastname) as authorname' )
			->from( 'Songs as s' )
			->join( 'Authors as a', 's.authorID = a.ID' )
			->get()->result_array();
	}
}