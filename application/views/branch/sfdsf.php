if(is_fri_open==1)
{
status_value=is_fri_open==1?"OPEN":"CLOSE";
tag="fri";
timetable_day=fri;
time_table_option=is_fri_open;

$("#"+tag+"_status").html(status_value);

$("#h_"+tag+"_status").val(time_table_option);
var fri_array=fri_time.split(",");

slot_no_array[timetable_day]=fri_array.length;

$("#h_"+tag+"_total_slot").val(slot_no_array[timetable_day]);

for(var i=1;i<=fri_array.length;i++)
{
var db_time_array=fri_array[i-1].split("-");
$("#"+tag+"_slot_start_time_"+i).html(db_time_array[0]);
$("#"+tag+"_slot_end_time_"+i).html(db_time_array[1]);
$("#"+tag+"_delete_slot_"+i).html('<a href="javascript:void(0)" class="action action-delete" onclick="delet_time_slot('+timetable_day+','+i+');"><i class="far fa-trash-alt"></i></a>');

$("#h_"+tag+"_slot_start_time_"+i).val(db_time_array[0]);
$("#h_"+tag+"_slot_end_time_"+i).val(db_time_array[1]);
}
}
else
{
//Closed
status_value=is_fri_open==1?"OPEN":"CLOSE";
tag="fri";
timetable_day=fri;
time_table_option=is_fri_open;

$("#"+tag+"_status").html(status_value);

$("#h_"+tag+"_status").val(time_table_option);

slot_no_array[sat]=0;
$("#"+tag+"_slot_start_time_1").html("");
$("#"+tag+"_slot_end_time_1").html("");
$("#"+tag+"_delete_slot_1").html('<a href="javascript:void(0)" class="action action-delete" onclick="delet_time_slot('+timetable_day+','+slot_no_array[timetable_day]+');"><i class="far fa-trash-alt"></i></a>');

$("#"+tag+"_slot_start_time_2").html("");
$("#"+tag+"_slot_end_time_2").html("");
$("#"+tag+"_delete_slot_2").html('');

$("#h_"+tag+"_slot_start_time_1").val("");
$("#h_"+tag+"_slot_end_time_1").val("");
$("#h_"+tag+"_slot_start_time_2").val("");
$("#h_"+tag+"_slot_end_time_2").val("");

$("#h_"+tag+"_total_slot").val(slot_no_array[timetable_day]);
}