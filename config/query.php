<?php
    return [
        'posts_by_user'=> 'select a.pid, a.title, DATE_FORMAT(a.created_at, "%M %d, %Y") created_at, SUBSTRING(a.content, 1, 100) shortdesc, a.subject from post_detail a, post_master b where a.pid = b.pid and b.author = ? order by a.created_at desc',
        'getpost'=> 'select a.*, b.author, b.approved_by, b.visible from post_detail a, post_master b where a.pid= ? and a.pid = b.pid and b.author = ? limit 1',
        'public_posts'=> 'select a.pid, a.title, DATE_FORMAT(a.created_at, "%M %d, %Y") created_at, a.subject, a.read_time, c.name author from post_detail a, post_master b, users c where a.pid = b.pid and b.author = c.id and b.is_approved = 1 and b.deleted = 0 and b.visible = 1 order by a.created_at desc',
    ];
?>