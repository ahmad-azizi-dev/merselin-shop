<div class="modal fade edit" id="editSlide{{$slide->id}}">
	<div class="modal-dialog modal-lg rtl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h5 class="modal-title text-info"><i class="fa fa-edit"></i>
					edit slide</h5>
				<button type="button" class="close" data-dismiss="modal">&times;
				</button>
			</div>
			@livewire('admin.slides.update-slide',[
			'slideId'=>$slide->id,
			'title'=>$slide->title,
			'button_name'=>$slide->button_name,
			'content'=>$slide->content,
			'link'=>$slide->link,
			'priority'=>$slide->priority,
			'imgName'=>$slide->img,
			],key($slide->id))
		</div>
	</div>
</div>