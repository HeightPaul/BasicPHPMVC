<?php

namespace test\models;

/**
 * @brief	Authors' class model
 */
class Authors extends AbstractModel
{
	/**
	 * @brief	Getting all data with SQL query.
	 *
	 * @return	array
	 */
	public function selectAll()
	{
		return $this->db->get( 'Authors' )->result_array();
	}

	/**
	 * @brief	Getting data with SQL query by id.
	 *
	 * @param	string $id
	 *
	 * @details	As MySQL query: " SELECT * FROM Authors WHERE ID = " . $id .";";
	 *
	 * @return	array
	 */
	public function selectById( $id )
	{
		return $this->db->where( 'ID', $id )->get( 'Authors' )->result_array();
	}

	/**
	 * @brief	Inserting a new row with SQL query.
	 *
	 * @param	string $firstname
	 * @param	string $lastname
	 * @param	string $author
	 *
	 * @return	string
	 */
	public function insertAuthor( $firstname, $lastname )
	{
		$data	= array(
			'firstname'		=> $firstname,
			'lastname'		=> $lastname
		);

		$sql	= $this->db->insert( 'Authors', $data );

		if ( $sql === true )
		{
			return "Author inserted successfully with ID: " . $this->db->insert_id() . "!";
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
	 * @param	string $firstname
	 * @param	string $lastname
	 *
	 * @return	 string
	 */
	public function editAuthor( int $id, string $firstname, string $lastname ): string
	{
		$data	= array(
			'firstname'		=> $firstname,
			'lastname'		=> $lastname
		);

		$sql	= $this->db->where( 'ID', $id )->update( 'Authors', $data );

		if ( $sql === true )
		{
			return "Author edited successfully with ID:" . $id . "!";
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
	 * @details	As SQL query: " DELETE FROM Authors WHERE ID=" . $id . ";"
	 *
	 * @return	string
	 */
	public function deleteAuthor( int $id ): string
	{
		$sql	= $this->db->where( 'ID' , $id )->delete( 'Authors' );

		if ( $sql === true )
		{
			return "Author deleted successfully!";
		}
		else
		{
			return "Error: " . $sql . " | " . $sql->error;
		}
	}

	/**
	 * @brief	 Pager for child models.
	 *
	 * @param	 int $currentPage
	 * @param	 int $length
	 *
	 * @return	array
	 */
	public function pagedSelect( int $currentPage, int $length ): array
	{
		$start	= ( $currentPage * $length ) - $length;

		return $this->db->get( 'Authors', $length, $start )->result_array();
	}

	/**
	 * @brief	Pager for child models.
	 *
	 * @details	SQL count query: 'SELECT COUNT(ID) FROM Authors ;'
	 *
	 * @param	int $length
	 *
	 * @return	int
	 */
	public function pagesCount( int $length ): int
	{
		$result		= $this->db->get('Authors', $length, 0)->result_array();

		$countAll	= $this->db->select( 'COUNT(ID)' )->get( 'Authors' )->result_array();

		return intval( ceil( $countAll[0]['COUNT(ID)'] / count( $result ) ) );
	}

	/**
	 * @brief	Pager for child models.
	 *
	 * @param	string $firstname
	 * @param	string $lastname
	 * @param	string $author
	 *
	 * @return	array
	 */
	public function filteredSelect( string $firstname, string $lastname ): array
	{
		return $this->db
			->where( 'firstname', $firstname )
			->or_where( 'lastname', $lastname )
			->get( 'Authors' )->result_array();
	}
}