/**
*papers.js for zzc
*create：2015年4月29日 13:19:26
**/
$(document).ready(function(){
            //初始化
            $(".sel_t").val('0');
            var $input = $("input");
            //选择添加类型
            var $input = $("input");
            $(".sel_t").change(function(){
                if($(this).val() == 1)
                {
                //填空题
                    $(".fi_q").show();
                    $(".rw_q").hide();
                    $(".choice").hide();
                    $(".operation_q").hide();
                    $input.val('');
                }
                if($(this).val() == 2)
                {
                //判断题
                    $(".fi_q").hide();
                    $(".rw_q").show();
                    $(".choice").hide();
                    $(".operation_q").hide();
                    $input.val('');
                }
                if($(this).val() == 3)
                {
                //选择题
                    $(".fi_q").hide();
                    $(".rw_q").hide();
                    $(".choice").show();
                    $(".operation_q").hide();
                    $input.val('');
                }
                if($(this).val() == 4)
                {
                //操作题
                    $(".fi_q").hide();
                    $(".rw_q").hide();
                    $(".choice").hide();
                    $(".operation_q").show();
                    $input.val('');
                }
                //显示提交按钮
                $(".add_btn").show();
            });
        //表单提交
        $("button:submit").click(function() {
            var self = $("form");
            $.post(self.attr("action"),self.serialize(),success,'json');
            return false;
            function success(data){
                if(data.status){
                    alert("添加成功");
                    $input.val('');
                }
            }
        });
});