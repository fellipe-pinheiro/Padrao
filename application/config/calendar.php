<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'start_day'    => 'sunday',
	'month_type'   => 'long',
	'day_type'     => 'short',
	'show_next_prev'  => false
	);
/*
$config['template'] = '

    {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

    {heading_row_start}<tr>{/heading_row_start}

    {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
    {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
    {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

    {heading_row_end}</tr>{/heading_row_end}

    {week_row_start}<tr>{/week_row_start}
    {week_day_cell}<td>{week_day}</td>{/week_day_cell}
    {week_row_end}</tr>{/week_row_end}

    {cal_row_start}<tr>{/cal_row_start}
    {cal_cell_start}<td>{/cal_cell_start}
    {cal_cell_start_today}<td>{/cal_cell_start_today}
    {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

    {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
    {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

    {cal_cell_no_content}{day}{/cal_cell_no_content}
    {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

    {cal_cell_blank}&nbsp;{/cal_cell_blank}

    {cal_cell_other}{day}{/cal_cel_other}

    {cal_cell_end}</td>{/cal_cell_end}
    {cal_cell_end_today}</td>{/cal_cell_end_today}
    {cal_cell_end_other}</td>{/cal_cell_end_other}
    {cal_row_end}</tr>{/cal_row_end}

    {table_close}</table>{/table_close}
';

$config['template'] = '
	{table_open}<table class="table table-hover">{/table_open}

	{heading_row_start}<tr>{/heading_row_start}

	{heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
	{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
	{heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

	{heading_row_end}</tr>{/heading_row_end}

	                //Deciding where to week row start
	{week_row_start}<tr class="week_name" >{/week_row_start}
	                //Deciding  week day cell and  week days
	{week_day_cell}<td >{week_day}</td>{/week_day_cell}
	                //week row end
	{week_row_end}</tr>{/week_row_end}

	{cal_row_start}<tr>{/cal_row_start}
	{cal_cell_start}<td>{/cal_cell_start}

	{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
	{cal_cell_content_today}<div class="today"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

	{cal_cell_no_content}{day}{/cal_cell_no_content}
	{cal_cell_no_content_today}<div class="today">{day}</div>{/cal_cell_no_content_today}

	{cal_cell_blank}&nbsp;{/cal_cell_blank}

	{cal_cell_end}</td>{/cal_cell_end}
	{cal_row_end}</tr>{/cal_row_end}

	{table_close}</table>{/table_close}
';
*/
/* End of file calendar.php */
/* Location: ./application/config/calendar.php */

