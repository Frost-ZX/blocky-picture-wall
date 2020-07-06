<?php
/* 禁止直接访问*/
if (!defined('IN_MAIN')) {
    die('禁止访问！');
}

/* 设置 */
class LoadSettings
{
    /* 处理 JSON */
    public $settings_json = 'assets/json/settings.json';
    public $settings_json_content = '';
    public $settings_json_data = '';
    /* 读取内容 */
    public function readSettings()
    {
        $this->settings_json_content = file_get_contents($this->settings_json) or die('Settings 文件不存在！');
        $this->settings_json_data = json_decode($this->settings_json_content, true);
    }
    public function getSiteTitle()
    {
        echo $this->settings_json_data['Site']['Title'];
    }
    public function getSiteSubtitle()
    {
        echo $this->settings_json_data['Site']['Subtitle'];
    }
    public function getSiteOwner()
    {
        echo $this->settings_json_data['Site']['Owner'];
    }
    public function getPersonalAbout()
    {
        $lines = $this->settings_json_data['Personal']['About'];
        foreach ($lines as $line) {
            echo $line . '<br>';
        }
    }
    public function getPersonalContactLinks()
    {
        $link_type = $this->settings_json_data['Personal']['Contact']['Link_Type'] or $link_type = 'text'; // 链接类型（默认：text）
        $links = $this->settings_json_data['Personal']['Contact']['Links'];
        if ($link_type == 'text') {
            // 链接类型：文本
            foreach ($links as $link) {
                echo '<li><a href="' . $link['Link'] . '" class="text"><span class="label">' . $link['Name'] . '</span></a></li>';
            }
        } else {
            // 链接类型：图标
            foreach ($links as $link) {
                echo '<li><a href="' . $link['Link'] . '" class="icon ' . $link['Icon_Class'] . '"><span class="label">' . $link['Name'] . '</span></a></li>';
            }
        }
    }
}

/* 图片 */
class LoadImages
{
    /* 处理 JSON */
    public $images_json = 'assets/json/images.json';
    public $images_json_content = '';
    public $images_json_data = '';
    public $page_max = 1;
    /* 读取内容 */
    public function readImages()
    {
        $this->images_json_content = file_get_contents($this->images_json) or die('Images 文件不存在！');
        $this->images_json_data = json_decode($this->images_json_content, true);
    }
    public function getImages($page)
    {
        $image_config = $this->images_json_data['Config'];   // 图片配置
        $image_dir = $image_config['Image_Dir'];             // 图片文件夹
        $image_count = $image_config['Page_Max_Images'];     // 每页的图片数量
        $image_thumb_suffix = $image_config['Thumb_Suffix'] or $image_thumb_suffix = ''; // 缩略图文件名后缀（全局）
        $images = $this->images_json_data['Images'];         // 图片列表
        $images_size = sizeof($images);                      // 图片总数
        $image_min = ($page - 1) * $image_count;             // 当前页第一张图的索引值
        $image_max = $page * $image_count - 1;               // 当前页最后一张图的索引值
        $this->page_max = ceil($images_size / $image_count); // 最大的页数
        if ($image_min < 0 || $image_min >= $images_size) {
            die('不存在该页');
        }
        /* 遍历输出 */
        for ($image_index = $image_min; $image_index <= $image_max && $image_index < $images_size; $image_index++) {
            echo '<article class="thumb">';

            $image_type = $images[$image_index]['Image_Type'] or $image_type = 'local'; // 图片来源类型（默认：local）
            $image_src = $images[$image_index]['Image_Src'];                            // 图片来源
            if ($image_type == 'local') {
                $image_src = $image_dir . $image_src;                                   // 本地图片
            }
            // 缩略图文件名后缀（覆盖）
            $image_thumb_suffix_override = $images[$image_index]['Thumb_Suffix'] or $image_thumb_suffix_override = $image_thumb_suffix;
            echo '<a data-original="' . $image_src . $image_thumb_suffix_override . '" class="image lazy" href="' . $image_src . '" class="image"><img src="blank.png" /></a>';
            echo '<h2>' . $images[$image_index]['Title'] . '</h2>';
            echo '<p>';
            $tags = $images[$image_index]['Tags'] or $tags = false;
            if ($tags) {
                foreach ($tags as $tag) {
                    echo '<span>' . $tag . '</span>';
                }
                echo '<br>';
            }
            $lines = $images[$image_index]['Content'] or $lines = false;
            if ($lines) {
                foreach ($lines as $line) {
                    echo $line . '<br>';
                }
            }
            echo '</p>';
            echo '</article>';
        }
    }
    /* 翻页 */
    public function getPager($page)
    {
        $max_page = $this->page_max;
        $page_pre = $page - 1;
        $page_next = $page + 1;
        if ($page_pre < 1) {
            $page_pre = '';
        } else {
            $page_pre = ' href="?page=' . $page_pre . '"';
        }
        if ($page_next > $max_page) {
            $page_next = '';
        } else {
            $page_next = ' href="?page=' . $page_next . '"';
        }
        echo '<a href="?page=1">首页</a>';
        echo '<a' . $page_pre . '><i class="fa fa-arrow-left"></i></a>';
        echo '<span>第 ' . $page . ' 页</span>';
        echo '<a' . $page_next . '><i class="fa fa-arrow-right"></i></a>';
        echo '<a href="?page=' . $max_page . '">末页</a>';
    }
}
