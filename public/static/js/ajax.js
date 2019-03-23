class Ajax {

	constructor(){
        this.domain ='';
    }

	post(url, data, success, error = function() {
		layer.msg('网络异常，请稍后再试',{time:1000})
	}) {

        if(this.isSet(window.lock)){
            if (lock){
                return '';
            }
            window.lock = true;
        }else{
            window.lock = true;
        }

        var index = layer.load(2, {shade: false}); //0代表加载的风格，支持0-2
        if(this.isFormData(data)){
            var processState = false;
        }else{
            var processState = true;
        }
		$.ajax({
			url: url,
			data: data,
			type: 'post',
			dataType: 'json',
			processData: processState,
			contentType: false,
			xhrFields: {
				withCredentials: true,
			},
			success: function(res) {
                window.lock = false;
                layer.close(index);
				success(res);
			},
			error: function($error) {
                window.lock = false;
                layer.close(index);
				error($error);
			}
		})
	}
	
	get(url, data, success, error = function() {
		layer.msg('网络异常，请稍后再试',{time:1000})
	}) {
        var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
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
                layer.close(index);
				success(res);
			},
			error: function() {
                layer.close(index);
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

     isSet(variableName) {
        try {
            if (typeof(variableName) == "undefined") {
                return false;
            } else {
                return true;
            }
        } catch (e) {
            console.log(variableName + "-------我异常了........");
        }
        return false;
    }
}

ajax = new Ajax();
