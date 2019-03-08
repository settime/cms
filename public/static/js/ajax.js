class Ajax {

	constructor(){
        this.domain ='';
    }

	post(url, data, success, error = function() {
		layer.msg('网络异常，请稍后再试',{time:1000})
	}) {
        if(this.isFormData(data)){
            var processState = false;
        }else{
            var processState = true;
        }
		$.ajax({
			url: this.domain + url,
			data: data,
			type: 'post',
			dataType: 'json',
			processData: processState,
			contentType: false,
			xhrFields: {
				withCredentials: true,
			},
			success: function(res) {
				success(res);
			},
			error: function($error) {
				error($error);
			}
		})
	}
	
	get(url, data, success, error = function() {
		layer.msg('网络异常，请稍后再试',{time:1000})
	}) {
		
		if(this.isFormData(data)){
			var processState = false;
		}else{
			var processState = true;
		}
		$.ajax({
			url: url,
			data: data,
			type: 'get',
			dataType: 'json',
			processData: processState,
			contentType: false,
			xhrFields: {
				withCredentials: true,
			},
			success: function(res) {
				success(res);
			},
			error: function() {
				error();
			}
		})
	}

	isFormData(data){
        var isFormData = (v) => {
            return Object.prototype.toString.call(v) === '[object FormData]';
        };
        if(isFormData(data)){
        	return true;
        }else{
        	return false;
        }
	}
}

ajax = new Ajax();
