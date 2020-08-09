<?php
    return [
        'posts_by_user'=> 'select a.pid, a.title, DATE_FORMAT(a.created_at, "%M %d, %Y") created_at, a.subject, b.visible, b.is_approved approved from post_detail a, post_master b where a.pid = b.pid and b.author = ? order by a.created_at desc',
        'getpost'=> 'select a.*, b.author, b.approved_by, b.visible from post_detail a, post_master b where a.pid= :PID and a.pid = b.pid and b.is_approved= :APPRV and b.deleted = :DEL',
        'get_author_post' => 'select a.*, b.author, b.approved_by, b.visible, b.is_approved from post_detail a, post_master b where a.pid= ? and a.pid = b.pid',
        'public_posts'=> 'select a.pid, a.title, DATE_FORMAT(a.created_at, "%M %d, %Y") created_at, a.subject, a.read_time, c.name author from post_detail a, post_master b, users c where a.pid = b.pid and b.author = c.id and b.is_approved = 1 and b.deleted = 0 and b.visible = 1 order by a.created_at desc',
        'hide_post' => 'update post_master set visible = not visible where pid = :PID'
    ];
?>