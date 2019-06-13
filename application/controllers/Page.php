<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public $data = array();
    function __construct() {
		parent::__construct();
		$except_uris = array('signin', 'page/do_signin', 'signout');
		if (in_array(uri_string(), $except_uris) == FALSE) {
			if (! (bool) $this->session->userdata('signedin')) {
				redirect('signin', 'refresh');
			}
		}
		$this->data['menus'] = array(
			array('icon' => 'docs', 'title' => 'Event Summary Report', 'slug' => 'event-summary-report'),
			array('icon' => 'docs', 'title' => 'Call Detail Record Report', 'slug' => 'cdr-report')
		);
		if ($this->session->userdata('user_type') == 'Admin') {
			$this->data['menus'][] = array('icon' => 'users', 'title' => 'Users', 'slug' => 'users');
			$this->data['menus'][] = array('icon' => 'settings', 'title' => 'Settings', 'slug' => 'settings');
		}
		$this->data['menus'][] = array('icon' => 'power', 'title' => 'Sign Out', 'slug' => 'signout');
		$this->data['alert'] = ($this->session->flashdata('alert'))? $this->session->flashdata('alert'): NULL;
		$this->data['current_page'] = $this->uri->segment(1)? $this->uri->segment(1): 'home';
		$this->data['secondary_menu'] = $this->uri->segment(2)? $this->uri->segment(2): NULL;
		$this->data['current_tabs'] = ($this->session->flashdata('current_tabs'))? $this->session->flashdata('current_tabs'): '1';
	}

	public function view() {
		if ($this->uri->segment(1) == 'users') {
			if ($this->uri->segment(2) == 'edit') {
				$this->form_validation->set_rules('user-form-username', 'Username', 'required');
				$this->form_validation->set_rules('user-form-user-type', 'User Type', 'required');
				if ($this->form_validation->run()) {
					$user = array('username' => $this->input->post('user-form-username'),
					'user_type' => $this->input->post('user-form-user-type'));
					$this->db->where('user_id', $this->uri->segment(3));
					$this->db->update('ci_users', $user);
					if ($this->db->affected_rows() > 0) {
						$alert_array = array('type' => 'success', 'msg' => 'Edit user success !');
						$this->session->set_flashdata('alert', $alert_array);
						redirect('users/edit/' . $this->uri->segment(3), 'refresh');
					} else {
						$alert_array = array('type' => 'danger', 'msg' => 'Cannot edit user !');
						$this->session->set_flashdata('alert', $alert_array);
						redirect('users/edit/' . $this->uri->segment(3), 'refresh');
					}
				}
				$this->data['page'] = 'user_form';
				$this->db->where('user_id', $this->uri->segment(3));
				$query = $this->db->get('ci_users');
				$user = $query->row_array();
				$this->data['user'] = $user;
			} elseif ($this->uri->segment(2) == 'delete') {
				$user = array('user_status' => 'Inactive');
				$this->db->where('user_id', $this->uri->segment(3));
				$this->db->update('ci_users', $user);
				if ($this->db->affected_rows() > 0) {
					$alert_array = array('type' => 'success', 'msg' => 'Delete user success !');
					$this->session->set_flashdata('alert', $alert_array);
					redirect('users', 'refresh');
				} else {
					$alert_array = array('type' => 'danger', 'msg' => 'Cannot delete user !');
					$this->session->set_flashdata('alert', $alert_array);
					redirect('users', 'refresh');
				}
			} elseif ($this->uri->segment(2) == 'create') {
				$this->form_validation->set_rules('user-form-username', 'Username', 'required');
				$this->form_validation->set_rules('user-form-user-type', 'User Type', 'required');
				$this->form_validation->set_rules('user-form-password', 'Password', 'required');
				$this->form_validation->set_rules('user-form-conf-password', 'Confirm Password', 'required|matches[user-form-password]');
				if ($this->form_validation->run()) {
					$user = array('username' => $this->input->post('user-form-username'),
					'user_password' => md5($this->input->post('user-form-password')),
					'user_type' => $this->input->post('user-form-user-type'));
					$this->db->insert('ci_users', $user);
					if ($this->db->affected_rows() > 0) {
						$alert_array = array('type' => 'success', 'msg' => 'Create user success !');
						$this->session->set_flashdata('alert', $alert_array);
						redirect('users', 'refresh');
					} else {
						$alert_array = array('type' => 'danger', 'msg' => 'Cannot create user !');
						$this->session->set_flashdata('alert', $alert_array);
						redirect('users', 'refresh');
					}
				}
				$this->data['page'] = 'users/create_form';
			} else {
				$this->db->where('user_status', 'Active');
				$this->db->order_by('created_at', 'DESC');
				$query = $this->db->get('ci_users');
				$users = $query->result_array();
				$this->data['users'] = $users;
				$this->data['page'] = 'users';
			}
			$this->data['page_breadcrumb'] = 'Users';
			$this->data['page_title'] = 'Users Management';
		} else if ($this->uri->segment(1) == 'settings') {
			$this->db->where('option_key', 'cdr_path');
			$query = $this->db->get('ci_options');
			$option = $query->row_array();
			$this->data['option'] = $option;
			$this->db->order_by('event_seq', 'ASC');
			$query = $this->db->get('ci_events');
			$events = $query->result_array();
			$this->data['events'] = $events;
			$this->data['page'] = 'settings/list';
			$this->data['page_breadcrumb'] = 'Settings';
			$this->data['page_title'] = 'Settings';
		} else {
			/* home */
			$this->data['page'] = 'home';
			$this->data['page_breadcrumb'] = NULL;
			$this->data['page_title'] = NULL;
		}
		$this->load->view('template', $this->data);
	}

	public function report() {
		$this->data['page'] = 'event-summary-report';
		$this->data['page_breadcrumb'] = 'Event Summary Report';
		$this->data['page_title'] = 'Event Summary Report <small>(Daily, Monthly, Yearly)</small>';
		$this->db->where('event_flag', 'Y');
		$this->db->order_by('event_seq', 'ASC');
		$query = $this->db->get('ci_events');
		$this->data['events'] = $query->result_array();
		if ($this->uri->segment(2)) {
			$select_events = ($this->input->post('report-form-events[]'))? implode(',', $this->input->post('report-form-events[]')): NULL;
			if ($this->input->post('report-type') == 'daily') {
				$this->form_validation->set_rules('report-date', 'Date', 'required');
				$in_time_from = ($this->input->post('time-from'))? $this->input->post('time-from'): '00:00';
				$in_time_to = ($this->input->post('time-to'))? $this->input->post('time-to'): '23:59';
				if ($this->form_validation->run()) {
					$sql = "select c.event_id, date_format(c.dtm, '%H') hh, count(*) amt ";
					$sql .= "from ci_load_cdr c ";
					$sql .= "join ci_events e ";
					$sql .= "on c.event_id = e.event_id ";
					$sql .= "and e.event_flag = 'Y' ";
					if ($select_events != NULL) {
						$sql .= "and e.event_id in ($select_events) ";
					}
					$sql .= "where c.dtm >= ? ";
					$sql .= "and c.dtm <= ? ";
					$sql .= "group by c.event_id, date_format(c.dtm, '%H') ";
					$conditions = array(
						$this->input->post('report-date') . ' ' . $in_time_from,
						$this->input->post('report-date') . ' ' . $in_time_to
					);
					$query = $this->db->query($sql, $conditions);
					echo $this->db->last_query();
					if ($query->num_rows() > 0) {
						$this->data['page_title'] = 'Event Summary Report (Daily: ' . $this->input->post('report-date') . ')';

						$time_from = explode(':', $in_time_from);
						$this->data['time_from'] = intval($time_from[0]);
						$time_to = explode(':', $in_time_to);
						$this->data['time_to'] = intval($time_to[0]);

						foreach ($query->result_array() as $row) {
							$cdr[$row['event_id']][intval($row['hh'])] = $row['amt'];
							$pie_chart[$row['event_id']] = array_sum($cdr[$row['event_id']]);
						}

						$this->db->where('event_flag ', 'Y');
						$query = $this->db->get('ci_events');
						foreach ($query->result_array() as $row) {
							$events[$row['event_id']] = array('event_name' => $row['event_name'], 'event_color' => $row['event_color']);
						}
						$this->data['events'] = $events;

						foreach ($cdr as $k => $v) {
							for ($i = intval($time_from[0]); $i <= intval($time_to[0]); $i += 1) {
								if (!array_key_exists($i,$v)) {
									$cdr[$k][$i] = 0;
								}
							}
							ksort($cdr[$k]);
							$chart_line['events'][$k] = array(
								'label' => $events[$k]['event_name'],
								'data' => implode(',', $cdr[$k]),
								'color' => 'rgb(' . $events[$k]['event_color'] . ')'
							);
							$cdrs[$k] = $cdr[$k];
						}

						//for javascript
						for ($i = $time_from[0]; $i < $time_to[0]; $i += 1) {
							$hh[] = $i;
						}
						$chart_line['labels'] = implode(',', $hh);
						$this->data['chart_line'] = $chart_line;
						
						// pie chart
						foreach (array_keys($pie_chart) as $pie_chart_key) {
							$pie_chart_label[] = "'" . $events[$pie_chart_key]['event_name'] . "'";
							$pie_chart_color[] = "'rgb(" . $events[$pie_chart_key]['event_color'] . ")'";
						}
						
						$pie_chart_array = array(
							'data' => implode(',', $pie_chart),
							'labels' => implode(',', $pie_chart_label),
							'color' => implode(',', $pie_chart_color)
						);

						$this->data['pie_chart'] = $pie_chart_array;

						
						$this->data['cdrs'] = $cdrs;
						$this->data['page'] = 'report/daily';

						foreach ($cdrs as $key => $val) {
							$export_data_arr[$events[$key]['event_name']] = $val;
						}
						$this->data['excel_file'] = $this->do_export_excel($this->data['page_title'], $this->data['time_from'], $this->data['time_to'], $export_data_arr);
						$this->data['pdf_file'] = $this->do_export_pdf($this->data['page_title'], $this->data['time_from'], $this->data['time_to'], $export_data_arr);
					} else {
						$alert_array = array(
							'type' => 'danger', 
							'msg' => 'No data found');
						$this->data['alert'] = $alert_array;
					}
				} else {
					if (validation_errors() != '') {
						$alert_array = array(
							'type' => 'danger', 
							'msg' => validation_errors());
						$this->data['alert'] = $alert_array;
					}
				}
			} else if ($this->input->post('report-type') == 'monthly') {
				$this->form_validation->set_rules('monthly-m', 'Month', 'required');
				if ($this->form_validation->run()) {
					$in_m = $this->input->post('monthly-m') . '-01';
					$d = strtotime($in_m);
					$last_date_of_month =  $this->input->post('monthly-m') . '-' . date('t', $d);
					$in_df = ($this->input->post('monthly-df'))? $this->input->post('monthly-df'): $in_m;
					$dtm_from = $in_df . ' 00:00:00'; /* for sql */
					$in_dt = ($this->input->post('monthly-dt'))? $this->input->post('monthly-dt'): $last_date_of_month;
					$dtm_to = $in_dt . ' 23:59:59'; /* for sql */
					$sql = "select e.event_id, e.event_seq, date_format(c.dtm, '%d') dd, count(*) amt ";
					$sql .= "from ci_load_cdr c ";
					$sql .= "join ci_events e ";
					$sql .= "on c.event_id = e.event_id ";
					$sql .= "and e.event_flag = 'Y' ";
					if ($select_events != NULL) {
						$sql .= "and e.event_id in ($select_events) ";
					}
					$sql .= "where c.dtm >= ? ";
					$sql .= "and c.dtm <= ? ";
					$sql .= "group by e.event_id, e.event_seq, date_format(c.dtm, '%d') ";
					$sql .= "order by e.event_seq, date_format(c.dtm, '%d')";
					$conditions = array($dtm_from, $dtm_to);
					$query = $this->db->query($sql, $conditions);
					// echo $this->db->last_query();
					if ($query->num_rows() > 0) {
						/* v_from, v_to */
						$df_arr = explode('-', $in_df);
						$this->data['v_from'] = intval($df_arr[2]);
						$dt_arr = explode('-', $in_dt);
						$this->data['v_to'] = intval($dt_arr[2]);

						/* loop cdr for formatting */
						foreach ($query->result_array() as $row) {
							/* for data table */
							$cdr[$row['event_id']][intval($row['dd'])] = $row['amt'];
							/* for pie chart */
							$pie_chart[$row['event_id']] = array_sum($cdr[$row['event_id']]);
						}

						//UPDATE `ci_events` SET `event_color`='229, 229, 229' WHERE `event_color` IS NULL;
						$this->db->where('event_flag ', 'Y');
						$query = $this->db->get('ci_events');
						foreach ($query->result_array() as $row) {
							$events[$row['event_id']] = array('event_name' => $row['event_name'], 'event_color' => $row['event_color']);
						}
						$this->data['events'] = $events;

						foreach ($cdr as $k => $v) {
							for ($i = $this->data['v_from']; $i <= $this->data['v_to']; $i += 1) {
								if (!array_key_exists($i,$v)) {
									$cdr[$k][$i] = 0;
								}
							}
							ksort($cdr[$k]);
							$cdrs[$k] = $cdr[$k];
							$line_chart['events'][$k] = array(
								'label' => $events[$k]['event_name'],
								'data' => implode(',', $cdr[$k]),
								'color' => 'rgb(' . $events[$k]['event_color'] . ')'
							);
						}

						/* set page title */
						$this->data['page_title'] = 'Event Summary Report (Monthly: ' . $this->input->post('monthly-m') . ')';

						/* set label for javascript */
						$line_chart['labels'] = implode(',', array_keys($cdrs[key($cdrs)]));

						$this->data['line_chart'] = $line_chart;
						
						// pie chart
						foreach (array_keys($pie_chart) as $pie_chart_key) {
							$pie_chart_label[] = "'" . $events[$pie_chart_key]['event_name'] . "'";
							$pie_chart_color[] = "'rgb(" . $events[$pie_chart_key]['event_color'] . ")'";
						}

						$pie_chart_array = array(
							'data' => implode(',', $pie_chart),
							'labels' => implode(',', $pie_chart_label),
							'color' => implode(',', $pie_chart_color)
						);

						// echo '<pre>';
						// print_r($events);
						// echo '</pre>';

						$this->data['m_pie_chart'] = $pie_chart_array;
						
						$this->data['cdrs'] = $cdrs;
						$this->data['page'] = 'report/monthly';

						foreach ($cdrs as $key => $val) {
							$export_data_arr[$events[$key]['event_name']] = $val;
						}
						$this->data['excel_file'] = $this->do_export_excel($this->data['page_title'], $this->data['v_from'], $this->data['v_to'], $export_data_arr);
						$this->data['pdf_file'] = $this->do_export_pdf($this->data['page_title'], $this->data['v_from'], $this->data['v_to'], $export_data_arr);
					} else {
						$alert_array = array(
							'type' => 'danger', 
							'msg' => 'No data found');
						$this->data['alert'] = $alert_array;
					}
				} else {
					$alert_array = array(
						'type' => 'danger', 
						'msg' => validation_errors());
					$this->data['alert'] = $alert_array;
				}
			} else if ($this->input->post('report-type') == 'yearly') {
				$this->form_validation->set_rules('yearly-y', 'Year', 'required');
				if ($this->form_validation->run()) {
					$group_by = 'm';
					$in_date_from = ($this->input->post('yearly-mf') == '')? $this->input->post('yearly-y') . '-01-01': $this->input->post('yearly-mf');
					$dtm_from = $in_date_from . ' 00:00:00'; /* for sql */
					$in_date_to = ($this->input->post('yearly-mt') == '')? $this->input->post('yearly-y') . '-12-31': $this->input->post('yearly-mf');
					$dtm_to = $in_date_to . ' 23:59:59'; /* for sql */
					$sql = "select e.event_id, e.event_seq, date_format(c.dtm, '%" . $group_by . "') dd, count(*) amt ";
					$sql .= "from ci_load_cdr c ";
					$sql .= "join ci_events e ";
					$sql .= "on c.event_id = e.event_id ";
					$sql .= "and e.event_flag = 'Y' ";
					if ($select_events != NULL) {
						$sql .= "and e.event_id in ($select_events) ";
					}
					$sql .= "where c.dtm >= ? ";
					$sql .= "and c.dtm <= ? ";
					$sql .= "group by e.event_id, e.event_seq, date_format(c.dtm, '%" . $group_by . "') ";
					$sql .= "order by e.event_seq, date_format(c.dtm, '%" . $group_by . "')";
					$conditions = array($dtm_from, $dtm_to);
					$query = $this->db->query($sql, $conditions);
					if ($query->num_rows() > 0) {
						/* v_from, v_to */
						$df_arr = explode('-', $in_date_from);
						$this->data['v_from'] = intval($df_arr[1]);
						$dt_arr = explode('-', $in_date_to);
						$this->data['v_to'] = intval($dt_arr[1]);

						/* loop cdr for formatting */
						foreach ($query->result_array() as $row) {
							/* for data table */
							$cdr[$row['event_id']][intval($row['dd'])] = $row['amt'];
							/* for pie chart */
							$pie_chart[$row['event_id']] = array_sum($cdr[$row['event_id']]);
						}

						$this->db->where('event_flag ', 'Y');
						$query = $this->db->get('ci_events');
						foreach ($query->result_array() as $row) {
							$events[$row['event_id']] = array('event_name' => $row['event_name'], 'event_color' => $row['event_color']);
						}
						$this->data['events'] = $events;

						foreach ($cdr as $k => $v) {
							for ($i = $this->data['v_from']; $i <= $this->data['v_to']; $i += 1) {
								if (!array_key_exists($i,$v)) {
									$cdr[$k][$i] = 0;
								}
							}
							ksort($cdr[$k]);
							$cdrs[$k] = $cdr[$k];
							$line_chart['events'][$k] = array(
								'label' => $events[$k]['event_name'],
								'data' => implode(',', $cdr[$k]),
								'color' => 'rgb(' . $events[$k]['event_color'] . ')'
							);
						}

						/* set page title */
						$this->data['page_title'] = 'Event Summary Report (Yearly: ' . $this->input->post('yearly-y') . ')';

						/* set label for javascript */
						$line_chart['labels'] = implode(',', array_keys($cdrs[key($cdrs)]));

						$this->data['line_chart'] = $line_chart;
						
						// pie chart
						foreach (array_keys($pie_chart) as $pie_chart_key) {
							$pie_chart_label[] = "'" . $events[$pie_chart_key]['event_name'] . "'";
							$pie_chart_color[] = "'rgb(" . $events[$pie_chart_key]['event_color'] . ")'";
						}

						$pie_chart_array = array(
							'data' => implode(',', $pie_chart),
							'labels' => implode(',', $pie_chart_label),
							'color' => implode(',', $pie_chart_color)
						);

						$this->data['m_pie_chart'] = $pie_chart_array;
						
						$this->data['cdrs'] = $cdrs;
						$this->data['page'] = 'report/yearly';

						foreach ($cdrs as $key => $val) {
							$export_data_arr[$events[$key]['event_name']] = $val;
						}
						$this->data['excel_file'] = $this->do_export_excel($this->data['page_title'], $this->data['v_from'], $this->data['v_to'], $export_data_arr);
						$this->data['pdf_file'] = $this->do_export_pdf($this->data['page_title'], $this->data['v_from'], $this->data['v_to'], $export_data_arr);
					} else {
						$alert_array = array(
							'type' => 'danger', 
							'msg' => 'No data found');
						$this->data['alert'] = $alert_array;
					}
				} else {
					$alert_array = array(
						'type' => 'danger', 
						'msg' => validation_errors());
					$this->data['alert'] = $alert_array;
				}
			}
		}
		$this->load->view('template', $this->data);
	}

	public function cdr_report() {
		$this->data['page'] = 'cdr-form';
		$this->data['page_breadcrumb'] = 'Call Detail Record Report';
		$this->data['page_title'] = 'Call Detail Record Report';
		$this->form_validation->set_rules('cdr-form-dtm-from', 'Date from', 'required');
		$this->form_validation->set_rules('cdr-form-dtm-to', 'Date to', 'required');
		// $in_time_from = ($this->input->post('time-from'))? $this->input->post('time-from'): '00:00';
		// $in_time_to = ($this->input->post('time-to'))? $this->input->post('time-to'): '23:59';
		if ($this->form_validation->run()) {
			$sql = "SELECT `dtm`, `ani`, `dnis`, `duration` ";
			$sql .= "FROM `ci_load_cdr` ";
			$sql .= "WHERE `event_id` = 6 ";
			$sql .= "AND `dtm` BETWEEN ? AND ? ";
			$sql .= "ORDER BY dtm ASC";
			$conditions = array(
				$this->input->post('cdr-form-dtm-from') . ' 00:00:00',
				$this->input->post('cdr-form-dtm-to') . ' 23:59:59'
			);
			$query = $this->db->query($sql, $conditions);
			if ($query->num_rows() > 0) {
				$this->data['page_title'] = 'Call Detail Record Report (' . $this->input->post('cdr-form-dtm-from') . ' <-> ' . $this->input->post('cdr-form-dtm-to') . ')';
				$cdr_arr = $query->result_array();
				$this->data['cdr_arr'] = $cdr_arr;
				$this->data['page'] = 'cdr-result';
				$this->data['excel_file'] = $this->cdr_report_2_excel($this->data['page_title'], $this->data['cdr_arr']);
				// echo '<pre>';
				// print_r($cdr_arr);
				// echo '</pre>';
			} else {
				$alert_array = array(
					'type' => 'danger', 
					'msg' => 'No data found');
				$this->data['alert'] = $alert_array;
			}
		} else {
			if (validation_errors() != '') {
				$alert_array = array(
					'type' => 'danger', 
					'msg' => validation_errors());
				$this->data['alert'] = $alert_array;
			}
		}
		$this->load->view('template', $this->data);
	}

	public function signin() {
		$this->load->view('signin', $this->data);
	}

	public function do_signin() {
		$redirect_to = 'signin';
		$this->form_validation->set_rules('signin-form-username', 'Username', 'required');
		$this->form_validation->set_rules('signin-form-password', 'Password', 'required');
		if ($this->form_validation->run()) {
			$this->db->select('username, user_type, 1 signedin');
			$this->db->where('username', $this->input->post('signin-form-username'));
			$this->db->where('user_password', md5($this->input->post('signin-form-password')));
			$this->db->where('user_status', 'Active');
			$query = $this->db->get('ci_users');
			if ($query->num_rows() > 0) {
				$user_array = $query->row_array();
				$this->session->set_userdata($user_array);
				$redirect_to = 'event-summary-report';
			} else {
				$alert_array = array(
					'type' => 'danger', 
					'msg' => 'The username or password is incorrect. Please try again.');
				$this->session->set_flashdata('alert', $alert_array);
			}
		} else {
			$alert_array = array(
				'type' => 'danger', 
				'msg' => validation_errors());
			$this->session->set_flashdata('alert', $alert_array);
		}
		redirect($redirect_to, 'refresh');
	}

	public function signout() {
		$this->session->sess_destroy();
		redirect('home', 'refresh');
	}

	public function do_export_excel($report_title, $report_from, $report_to, $report_data) {
		$this->load->library('export_excel');
		$objPHPExcel = new PHPExcel();

        $file_name = 'assets/export/event_summary_report_' . date('Ymd_His') .'.xls';
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $report_title);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'EVENT');
        $col = 1;

        for ($x = $report_from; $x <= $report_to; $x+=1) {
			if (strpos($report_title, 'Daily') > 0) {
				$v = str_pad($x, 2, 0, STR_PAD_LEFT);
			} else {
				$v = $x;
			}
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $v);
            $col += 1;
        }
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, 'TOTAL');
		$row = 2;
		foreach ($report_data as $event_name => $event_data) {
			$col = 0;
			$row += 1;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $event_name);
			$col += 1;
			foreach ($event_data as $hh => $amount) {
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $amount);
				$col += 1;
			}
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, array_sum($event_data));
		}

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($file_name);
		return $file_name;
	}

	public function do_export_pdf($report_title, $report_from, $report_to, $report_data) {
		$this->load->library('export_pdf');
		$file_name = 'assets/export/event_summary_report_' . date('Ymd_His') .'.pdf';
		$cell_height = 6;
		$cell_padding = 2;
		$this->export_pdf->AddPage();
		$this->export_pdf->AddFont('angsa', '', 'angsa.php');

		$cell_width = $this->export_pdf->GetStringWidth($report_title);
		$this->export_pdf->SetFont('angsa',NULL,10);
		$this->export_pdf->Cell($cell_width + 10, $cell_height, $report_title, 0, 1);

		$this->export_pdf->Cell(100,$cell_height,iconv('UTF-8', 'TIS-620', 'EVENT'), 1, 0, 'C');
		//
		// $report_from = 0;
		// $report_to = 23;
		for ($x = $report_from; $x <= $report_to; $x+=1) {
			if (strpos($report_title, 'Daily') > 0) {
				$v = str_pad($x, 2, 0, STR_PAD_LEFT);
			} else {
				$v = $x;
			}
            $this->export_pdf->Cell(6, $cell_height, $v, 1, 0, 'C');
        }
		$cell_width = $this->export_pdf->GetStringWidth('TOTAL');
        $this->export_pdf->Cell($cell_width + $cell_padding, $cell_height, 'TOTAL', 1, 1, 'C');
		//
		foreach ($report_data as $event_name => $event_data) {
			$this->export_pdf->Cell(100,$cell_height,iconv('UTF-8', 'TIS-620', $event_name), 1, 0, 'C');
			foreach ($event_data as $hh => $amount) {
				$this->export_pdf->Cell(6, $cell_height, $amount, 1, 0, 'C');
			}
			$this->export_pdf->Cell($cell_width + $cell_padding, $cell_height, array_sum($event_data), 1, 1, 'C');
		}
		//
		$this->export_pdf->Output($file_name,'F');
		return $file_name;
	}

	public function cdr_report_2_excel($report_title, $report_data) {
		$this->load->library('export_excel');
		$objPHPExcel = new PHPExcel();

        $file_name = 'assets/export/cdr_report_' . date('Ymd_His') .'.xls';
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $report_title);
		$header_arr = array('DATETIME', 'ANI', 'DNIS', 'DURATION');
		$col = 0;
		foreach ($header_arr as $header) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $header);
        	$col += 1;
		}

		$row = 3;
		foreach ($report_data as $r) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $r['dtm']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $r['ani']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $r['dnis']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $r['duration']);
			$row += 1;
		}

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($file_name);
		return $file_name;
	}

	public function do_update_option() {
		$this->form_validation->set_rules('setting-form-option-value', 'CDR Path', 'required');
		if ($this->form_validation->run()) {
			$option = array('option_value' => $this->input->post('setting-form-option-value'));
			$this->db->where('option_id', $this->input->post('setting-form-option-id'));
			$this->db->update('ci_options', $option);
			if ($this->db->affected_rows() > 0) {
				$alert_array = array('type' => 'success', 'msg' => 'Update success!');
				$this->session->set_flashdata('alert', $alert_array);
			} else {
				$alert_array = array('type' => 'danger', 'msg' => 'Cannot update option!');
				$this->session->set_flashdata('alert', $alert_array);
			}
		}
		redirect('settings', 'refresh');
	}

	public function do_create_event() {
		$this->session->set_flashdata('current_tabs', 2);
		$this->form_validation->set_rules('event-form-id', 'Event ID', 'required');
		$this->form_validation->set_rules('event-form-name', 'Event Name', 'required');
		if ($this->form_validation->run()) {
			$this->db->select_max('event_seq');
			$query = $this->db->get('ci_events');
			$max_seq = $query->row_array();
			$event_arr = array('event_id' => $this->input->post('event-form-id'),
			'event_name' => $this->input->post('event-form-name'),
			'event_flag' => $this->input->post('event-form-flag'),
			'event_color' => rand(0,255) . ',' . rand(0, 255) . ',' . rand(0,255),
			'event_seq' => $max_seq['event_seq'] + 1);
			$this->db->insert('ci_events', $event_arr);
			if ($this->db->affected_rows() > 0) {
				$alert_array = array('type' => 'success', 'msg' => 'Create success!');
				$this->session->set_flashdata('alert', $alert_array);
			} else {
				$alert_array = array('type' => 'danger', 'msg' => 'Cannot create event!');
				$this->session->set_flashdata('alert', $alert_array);
			}
		} else {
			$alert_array = array('type' => 'danger', 'msg' => validation_errors());
			$this->session->set_flashdata('alert', $alert_array);
		}
		redirect('settings', 'refresh');
	}

	public function do_update_event() {
		$this->session->set_flashdata('current_tabs', 2);
		$this->form_validation->set_rules('event-form-id', 'Event ID', 'required');
		$this->form_validation->set_rules('event-form-name', 'Event Name', 'required');
		if ($this->form_validation->run()) {
			$event_arr = array('event_id' => $this->input->post('event-form-id'),
			'event_name' => $this->input->post('event-form-name'),
			'event_flag' => $this->input->post('event-form-flag'));
			$this->db->where('event_id', $this->uri->segment(3));
			$this->db->update('ci_events', $event_arr);
			if ($this->db->affected_rows() > 0) {
				$alert_array = array('type' => 'success', 'msg' => 'Update success!');
				$this->session->set_flashdata('alert', $alert_array);
			} else {
				$alert_array = array('type' => 'danger', 'msg' => 'Cannot update event!');
				$this->session->set_flashdata('alert', $alert_array);
			}
		} else {
			$alert_array = array('type' => 'danger', 'msg' => validation_errors());
			$this->session->set_flashdata('alert', $alert_array);
		}
		redirect('settings', 'refresh');
	}

	public function do_delete_event() {
		$this->db->where('event_id', $this->uri->segment(3));
		$this->db->delete('ci_events');
		if ($this->db->affected_rows() > 0) {
			$alert_array = array('type' => 'success', 'msg' => 'Delete success!');
			$this->session->set_flashdata('alert', $alert_array);
		} else {
			$alert_array = array('type' => 'danger', 'msg' => 'Cannot delete event!');
			$this->session->set_flashdata('alert', $alert_array);
		}
		redirect('settings', 'refresh');
	}
}
