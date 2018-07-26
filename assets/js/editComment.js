class EditPost
{
	constructor()
	{
		this.addEvents();
		this.isActivated = false;
		this.host = 'http://localhost/projet_04/';
	}

	addEvents()
	{
		$('.editCommentButton').click((e) => {this.editPost(e)});
	}

	cancelEdit(e)
	{
		e.preventDefault();

		this.isActivated = false;
		this.$1.empty();
		this.$1.hide().append(this.$3).fadeIn(1000);
		this.targetButton.append(this.$1 > '.buttons');

		this.addEvents();
	}

	closeEditWindow(e)
	{
		this.cancelEdit(e);

		this.editPost(e);
	}

	editPost(e)
	{
		e.preventDefault();

		if(!this.isActivated)
		{
			this.isActivated = true;
			this.chapterId = $('#chapter h3').attr('id');
			this.targetButton = $('a[id="'+e.target.id+'"]');
			this.$1 = $('#c-'+e.target.id);
			this.$2 = $('#c-'+e.target.id+' > div').html();
			this.$3 = $('#c-'+e.target.id).html();
			this.$1.empty();
			$('a[id="'+e.target.id+'"]').remove();
			this.$1.hide().append('<div id="editPost"><form method="post" action="'+this.host+'editComment"><input type="hidden" name="id" value="'+e.target.id+'" /><input type="hidden" name="chapterId" value="'+this.chapterId+'" /><textarea name="message">'+this.$2+'</textarea><div class="buttons"><button type="reset" class="button cancelEdit" name="cancelEdit">Annuler</button> <button class="button" type="submit">Valider</button></div></form></div>').fadeIn(1000);
			
			tinymce.init({ selector:'textarea' });

			$('.cancelEdit').click((e) => {this.cancelEdit(e)});
		}
		else
		{
			this.closeEditWindow(e);
		}
	}
}
