<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
        $this->load->library(array('ion_auth', 'form_validation'));
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'message/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'message/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'message/index.html';
            $config['first_url'] = base_url() . 'message/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Message_model->total_rows($q);
        $message = $this->Message_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'message_data' => $message,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('message_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Message_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'group_id' => $row->group_id,
		'title' => $row->title,
		'body' => $row->body,
		'icon' => $row->icon,
		'tag' => $row->tag,
		'data' => $row->data,
		'created_date' => $row->created_date,
	    );
            $this->load->view('message_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('message/create_action'),
	    'id' => set_value('id'),
	    'group_id' => set_value('group_id'),
	    'title' => set_value('title'),
	    'body' => set_value('body'),
	    'icon' => set_value('icon'),
	    'tag' => set_value('tag'),
	    'data' => set_value('data'),
	    #'created_date' => set_value('created_date'),
	);
        $this->load->view('message_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'group_id' => $this->input->post('group_id',TRUE),
		'title' => $this->input->post('title',TRUE),
		'body' => $this->input->post('body',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'tag' => $this->input->post('tag',TRUE),
		'data' => $this->input->post('data',TRUE),
		'created_date' => $this->input->post('created_date',TRUE),
	    );

            $this->Message_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('message'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Message_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('message/update_action'),
		'id' => set_value('id', $row->id),
		'group_id' => set_value('group_id', $row->group_id),
		'title' => set_value('title', $row->title),
		'body' => set_value('body', $row->body),
		'icon' => set_value('icon', $row->icon),
		'tag' => set_value('tag', $row->tag),
		'data' => set_value('data', $row->data),
		'created_date' => set_value('created_date', $row->created_date),
	    );
            $this->load->view('message_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'group_id' => $this->input->post('group_id',TRUE),
		'title' => $this->input->post('title',TRUE),
		'body' => $this->input->post('body',TRUE),
		'icon' => $this->input->post('icon',TRUE),
		'tag' => $this->input->post('tag',TRUE),
		'data' => $this->input->post('data',TRUE),
		'created_date' => $this->input->post('created_date',TRUE),
	    );

            $this->Message_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('message'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Message_model->get_by_id($id);

        if ($row) {
            $this->Message_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('message'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }
	
	function get_message(){
		$row = $this->Message_model->get_most_recent();
		echo json_encode($row);
	}

    public function _rules() 
    {
	$this->form_validation->set_rules('group_id', 'group id', 'trim|required');
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('body', 'body', 'trim|required');
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('tag', 'tag', 'trim|required');
	$this->form_validation->set_rules('data', 'data', 'trim|required');
	$this->form_validation->set_rules('created_date', 'created date', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Message.php */
/* Location: ./application/controllers/Message.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-07-12 14:50:23 */
/* http://harviacode.com */