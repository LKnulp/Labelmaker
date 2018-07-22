/**
 * @brief Add a group of input-boxes below the header-DIV.
 * 
 * @param [in|out] type parameter_name Parameter description.
 * @return Description of returned value.
 */
function addGroup(input) {
	var oldValue = parseInt(LM(input).attr('count'));
	var newValue = parseInt(LM(input)[0].value);
	// get name of creation-function as string
	var createFunction = LM(input).attr('function');
	
	//do not allow negative values
	if(newValue < 0) {
		LM('div.group').each(function() {
			LM(this).remove();
		});
	}
	
	//if it was the first input after loading the form
	if(oldValue == 0) {
		for(var i=newValue; i>0; i--) {
			var group = window[createFunction](i);
			LM(input).after(group);
		}
	//every other entry afterwards
	} else {
		var diff  = newValue - oldValue; //if input was increased => diff > 0
		var steps = Math.abs(diff); //keep diff but calculate the necessary steps
		//input is higher than before
		if(diff > 0) {
			for(var i=newValue; i>(newValue-steps); i--) {
				var group = window[createFunction](i);
				LM('div#group'+oldValue).after(group);
			}
		//input is lower than before	
		} else if(diff < 0) {
			for(var j=oldValue; j>newValue; j--) {
				LM('div#group'+j).remove();
			}
		}
	}
	//store the new value
	LM(input).attr('count', newValue);
}

/**
 * @brief Insert form for container-set.
 * @param [in] int i Count of containers.
 */
function createGroupInput(i) {
	var group = document.createElement('div');
	group.setAttribute('class', 'group');
	group.setAttribute('id', 'group'+i);

	//title of countainerGroup
	var head = document.createElement('span');
	var headText = document.createTextNode('Schuber-Klassensatz '+i);
	head.appendChild(headText);

	//count of items in this container
	var containerCount = document.createElement('input');
	containerCount.setAttribute('placeholder', 'Anzahl an Büchern in diesen Schubern');
	containerCount.setAttribute('name', 'containerLabels'+i);
	containerCount.setAttribute('type', 'number');

	//count of containers with the same amount of items
	var conainerGroup = document.createElement('input');
	conainerGroup.setAttribute('placeholder', 'Anzahl an Schubern mit dieser Anzahl Bücher');
	conainerGroup.setAttribute('name', 'containers'+i);
	conainerGroup.setAttribute('type', 'number');

	group.appendChild(head);
	group.appendChild(containerCount);
	group.appendChild(conainerGroup);
	
	return group;
}

/**
 * @brief Show preview of selected image on logo-upload.
 * @param [in] object input HTML file-input-field.
 * 
 * Changes src-attribute of label-preview-image before upload.
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            LM('#logo').attr('src', e.target.result);
			LM('#logo').show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * @brief Show/ hide form by mode-value.
 * @param [string] mode value of div-id.
 */
function activateMode(mode) {
	LM('.header').each(function() {
		LM(this).hide();
	});
	LM('button.option').each(function() {
		LM(this).removeClass('active');
	});
	LM('button.'+mode).addClass('active');
	LM('#mode').val(mode);
	LM('#'+mode).show();
	LM('input[name=mode]').val(mode);
	//set default input for modes
	customizeMode(mode);
	//set mode value
	
}

/**
 * @brief Set default values for modes
 * @param [string] mode value of div-id.
 */
function customizeMode(mode) {
	LM('.header').children('input').each(function() {
		LM(this).val('');
	});
	switch(mode) {
		case 'mode1':
			LM('#startInt').val(1);
			break;
		case 'mode2':
			LM('#containerCount').val(1);
			LM('#containerCount').trigger('keyup');
			break;
	}
}

var LM = jQuery.noConflict();
LM(document).ready(function() {
	
	//do not show anything on pageload
	//activate second mode at first
	activateMode('mode1');
	
	//show every new image
	LM("#imgInp").change(function(){
		readURL(this);
	});
	LM("#containerCount").on('keyup',function(){
		addGroup(this);
	});
	LM('#disclaimerField').val(LM('#disclaimer').html());
	
	//INPUTS
	LM('.update').each(function() {
		LM(this).change(function() {
			var name 	= LM(this).attr('name');
			var val		= LM(this).val();
			LM('#'+name+'>.val').empty().html(val);
		});
	});
	LM('input').each(function() {
		if(LM(this).prop('required')){
			LM(this).addClass('required');
		}
	});
	
	//TESTING
	if(findGetParameter('debug') == 1) {
		LM('input[name=title]').val('Einstern');
		LM('input[name=class]').val('3a');
		LM('input[name=subject]').val('Mathe');
		LM('input[name=date]').val('20.08.2016');
	}

});

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}
