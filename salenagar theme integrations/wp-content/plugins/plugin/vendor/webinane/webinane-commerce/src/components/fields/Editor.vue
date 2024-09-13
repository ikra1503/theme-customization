<template>
	<div class="wpcm-settings-editor">
        <textarea :id="id" ref="editor" cols="30" rows="10" v-html="value"></textarea>
    </div>
</template>

<script>
export default {
	// props: ['value'],
    data() {
        return {
            value: '',
            id: ''
        }
    },
    mounted() {

    	this.id = this._uid
    	setTimeout(() => {
    		this.value = this.$attrs.value
        	this.editor()
    	}, 2000)
    },
    methods: {
        editor() {
			let thisis = this

			setTimeout(() => {
				// text editor
				wp.editor.remove(this.id)
				let $ = jQuery
			 	//let field_id = 'wp_editor_'+thisis.field.id
			    let mydef = wp.editor.getDefaultSettings().tinymce
			    
			    mydef.setup = (ed) => {
		    		ed.on('keyup', (e) => {
		    			// this.$set(this, 'value', ed.getContent())
		    			let content = ed.getContent()
		    			content = content.replace(/\n/g,"<br>")

		    			this.$emit('input', content)
		    			this.$emit('change', content)
		    		})
		    	}

			    wp.editor.initialize(this.id, { 
			    	tinymce : mydef,
			    });
			    
			 }, 500)
		},
		nl2br (str, is_xhtml) {
		  // http://kevin.vanzonneveld.net
		  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // +   improved by: Philip Peterson
		  // +   improved by: Onno Marsman
		  // +   improved by: Atli Þór
		  // +   bugfixed by: Onno Marsman
		  // +      input by: Brett Zamir (http://brett-zamir.me)
		  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // +   improved by: Brett Zamir (http://brett-zamir.me)
		  // +   improved by: Maximusya
		  // *     example 1: nl2br('Kevin\nvan\nZonneveld');
		  // *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
		  // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
		  // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
		  // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
		  // *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
		  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

		  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
		},
		getValue() {

		}
    }
}
</script>

<style lang="scss">
    .wpcm-settings-editor {
        margin-top: 20px;
    }
</style>