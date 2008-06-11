<?php
/**
 * Shop_CommentsTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Table.inc.php';

class
	Shop_CommentsTable
	extends
	Database_Table
{
	public function
		add_comment (
			$name,
			$ip,
			$email,
			$url,
			$homepage_title,
			$comment,
			$product_id,
			$status = 'new',
			$front_page = 'no'
		)
	{
		$database = $this->get_database();

		$commenters_table = $database->get_table('hpi_shop_commenters');

		$commenter_values = array();
		$commenter_values['name'] = $name;
		$commenter_values['url'] = $url;
		$commenter_values['homepage_title'] = $homepage_title;
		$commenter_values['email'] = $email;
		$commenter_values['joined'] = 'NOW()';

		$commenter_id = $commenters_table->add($commenter_values);


		// Check if comment is spam
		$comment_is_spam = $this->is_spam($comment);

		if ($comment_is_spam)
		{
			$status = 'moderation';
		}

		$comment_values = array();
		$comment_values['comment'] = $comment;
		$comment_values['commenter_id'] = $commenter_id;
		$comment_values['product_id'] = $product_id;
		$comment_values['ip'] = $ip;
		$comment_values['added'] = 'NOW()';
		$comment_values['modified'] = 'NOW()';
		$comment_values['status'] = $status;
		$comment_values['front_page'] = $front_page;
		$comment_values['sort_order'] = $this->max_all_rows('sort_order') + 1;

		return $this->add($comment_values);
	}

	public function
		edit_comment (
			$edit_id,
			$name,
			$email,
			$url,
			$homepage_title,
			$comment,
			$product_id,
			$status = 'new',
			$front_page = 'no'
		)
	{
		$database = $this->get_database();

		$commenters_table = $database->get_table('hpi_shop_commenters');

		$comment_row = $this->get_row_by_id($edit_id);
		$commenter_id = $comment_row->get_commenter_id();

		$commenter_values = array();
		$commenter_values['name'] = $name;
		$commenter_values['url'] = $url;
		$commenter_values['homepage_title'] = $homepage_title;
		$commenter_values['email'] = $email;

		$commenters_table->update_by_id($commenter_id, $commenter_values);

		$comment_values = array();
		$comment_values['comment'] = $comment;
		$comment_values['commenter_id'] = $commenter_id;
		$comment_values['product_id'] = $product_id;
		$comment_values['modified'] = 'NOW()';
		$comment_values['status'] = $status;
		$comment_values['front_page'] = $front_page;
		$comment_values['sort_order'] = $this->max_all_rows('sort_order') + 1;

		$this->update_by_id($edit_id, $comment_values);
	}

	public function
		delete_comment (
			$delete_id
		)
	{
		$database = $this->get_database();

		$commenters_table = $database->get_table('hpi_shop_commenters');

		$comment_row = $this->get_row_by_id($delete_id);

		#
		#Delete from Commenters table
		#
		$conditions['id'] = $comment_row->get_commenter_id();             
		$commenters_table->delete_where($conditions);

		#
		#Delete from comments table
		#
		$this->delete_by_id($comment_row->get_id());
	}

	public function
		add_comment_with_date (
			$name,
			$ip,
			$email,
			$url,
			$homepage_title,
			$comment,
			$product_id,
			$status = 'new',
			$front_page = 'no',
			$added
		)
	{
		$database = $this->get_database();

		$commenters_table = $database->get_table('hpi_shop_commenters');

		$commenter_values = array();
		$commenter_values['name'] = $name;
		$commenter_values['url'] = $url;
		$commenter_values['homepage_title'] = $homepage_title;
		$commenter_values['email'] = $email;
		$commenter_values['joined'] = $added;

		$commenter_id = $commenters_table->add($commenter_values);

		$comment_values = array();
		$comment_values['comment'] = $comment;
		$comment_values['commenter_id'] = $commenter_id;
		$comment_values['product_id'] = $product_id;
		$comment_values['ip'] = $ip;
		$comment_values['added'] = $added;
		$comment_values['modified'] = $added;
		$comment_values['status'] = $status;
		$comment_values['front_page'] = $front_page;
		$comment_values['sort_order'] = $this->max_all_rows('sort_order') + 1;

		return $this->add($comment_values);
	}

	public function
		count_comments()
	{
		return $this->count_all_rows();    
	}

	public function
		count_comments_for_status($status)
	{
		$conditions = array();
		$conditions['status'] = $status;
		return $this->count_rows_where($conditions);    
	}

	public function
		count_public_comments()
	{
		$conditions = array();
		$conditions['status'] = 'accepted';
		return $this->count_rows_where($conditions);    
	}

	public function
		count_front_page_comments()
	{
		$conditions = array();
		$conditions['front_page'] = 'yes';
		return $this->count_rows_where($conditions);

	}

	public function
		count_spam_comments()
	{
		$conditions = array();
		$conditions['status'] = 'spam';
		return $this->count_rows_where($conditions);
	}

	public function
		is_spam($comment)
	{
		$regex .= '{https?\://}i';

		if (preg_match($regex, $comment)) 
		{
			return TRUE;
		}
		return FALSE;
	}

	public function
		set_status($comment_id, $status)
	{
		$comment_values = array();
		$comment_values['status'] = $status;

		$this->update_by_id($comment_id, $comment_values);
	}
}
?>
