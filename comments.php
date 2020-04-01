<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
<div class="ds-post-main" id="<?php $comments->theId(); ?>">
	<div class="ds-avatar">
		<a href="<?php $comments->permalink(); ?>">
		
<?php $number=$comments->mail;
if(preg_match('|^[1-9]\d{4,11}@qq\.com$|i',$number)){
echo '<img src="https://q2.qlogo.cn/headimg_dl? bs='.$number.'&dst_uin='.$number.'&dst_uin='.$number.'&;dst_uin='.$number.'&spec=100&url_enc=0&referer=bu_interface&term_type=PC" width="46px" height="46px" style="border-radius: 5px;float: left;margin-top: 0px;margin-right: 10px;margin-bottom:-2px">'; 
}else{
echo '<img src="/usr/themes/Tstrap/images/avatar.jpg" width="46px" height="46px" style="border-radius: 5px;float: left;margin-top: 0px;margin-right: 10px;margin-bottom:-2px">';
}
?>
</a>

	</div>
	<div class="ds-comment-body"><cite class="fn"><?php $comments->author(); ?></cite> <?php $comments->date('Y-m-d H:i'); ?><span class="comment-reply"><?php $comments->reply(); ?></span>
	<p><?php echo preg_replace("/::([a-z]*)::/i", "<img src=\"/usr/themes/Tstrap/images/face/\\1.gif\"/>", $comments->content);?></p>
	</div>
</div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
<?php } ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>

    <?php $comments->listComments(); ?>

<?php $comments->pageNav('«', '»', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'typecho-pager floatnone', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
        <h4>发表评论</h4>
    	    	<form method="post" action="<?php $this->commentUrl() ?>" class="karigor-form" id="custom-field" role="form">
    		<div class="karigor-form-inner">
            <div class="karigor-form-input">
            <p class="comment-smilies">
                    <a class="add-smily" href="javascript:grin('::huaji::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/huaji.gif"></a>
                    <a class="add-smily" href="javascript:grin('::good::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/good.gif"></a>
                    <a class="add-smily" href="javascript:grin('::outwater::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/outwater.gif"></a>
                    <a class="add-smily" href="javascript:grin('::hotface::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/hotface.gif"></a>
                    <a class="add-smily" href="javascript:grin('::angry::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/angry.gif"></a>
                    <a class="add-smily" href="javascript:grin('::poor::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/poor.gif"></a>
                    <a class="add-smily" href="javascript:grin('::unhappy::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/unhappy.gif"></a>
                    <a class="add-smily" href="javascript:grin('::doubt::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/doubt.gif"></a>
                    <a class="add-smily" href="javascript:grin('::rose::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/rose.gif"></a>
                    <a class="add-smily" href="javascript:grin('::doge::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/doge.png"></a>
                    <a class="add-smily" href="javascript:grin('::erha::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/erha.png"></a>
                    <a class="add-smily" href="javascript:grin('::miaomiao::')"><img class="wp-smiley" src="/usr/themes/Tstrap/images/face/miaomiao.png"></a>
            </p>
                <textarea name="text" id="new-review-textbox" class="textarea" cols="30" rows="5" placeholder="请输入评论" required><?php $this->remember('text'); ?></textarea>
            </div>
            <?php if($this->user->hasLogin()): ?>
            <?php else: ?>
            
                昵称：<input name="author" type="text" class="text" id="new-review-name" value="<?php $this->remember('author'); ?>" placeholder="必填" required> &nbsp;
                </br>
                邮箱：<input name="mail" type="email" class="text" id="new-review-email" value="<?php $this->remember('mail'); ?>" placeholder="必填" required> &nbsp;
             </br>
                网址：<input name="url" type="text" class="text" id="new-review-url" value="<?php $this->remember('url'); ?>" placeholder="选填，请带协议头"> 
             </br>
            <?php endif; ?>
            <div class="karigor-form-input">
                <button type="submit" class="btn btn-primary">
                    <span>提交评论</span>
                </button>
            </div>
            </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>