<?php
/** 
 private * Created by PhpStorm. 
 private * User = Tsuneka 
 private * Date = 14-Dec-15 
 private * Time = 10:33 PM 
 private */

namespace KouTsuneka\FlashMessage;


class Message
{
    private $title;
    private $message;
    private $type;
    private $closeButton;
    private $debug;
    private $progressBar;
    private $preventDuplicates;
    private $positionClass;
    private $onclick;
    private $showDuration;
    private $hideDuration;
    private $timeOut;
    private $extendedTimeOut;
    private $showEasing;
    private $hideEasing;
    private $showMethod;
    private $hideMethod;

    public function __construct($type, $title, $message, $options)
    {
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        foreach($options as $k => $v)
            if(isset($this[$k]))
                $this[$k] = $v;
    }

    public function encode($strict = false)
    {
        if(!$strict)
            return json_encode($this->toArray());
        return json_encode([
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'options' => [
                "closeButton" => $this->closeButton,
                "debug" => $this->debug,
                "progressBar" => $this->progressBar,
                "preventDuplicates" => $this->preventDuplicates,
                "positionClass" => $this->positionClass,
                "onclick" => $this->onclick,
                "showDuration"  => $this->showDuration,
                "hideDuration" => $this->hideDuration,
                "timeOut" => $this->timeOut,
                "extendedTimeOut" => $this->extendedTimeOut,
                "showEasing" => $this->showEasing,
                "hideEasing" => $this->hideEasing,
                "showMethod" => $this->showMethod,
                "hideMethod" => $this->hideMethod
            ]
        ]);
    }
    public function toArray()
    {
        $arr = [];
        $arr['type'] = $this->type;
        $arr['title'] = $this->title;
        $arr['message'] = $this->message;
        $arr['options'] = [];
        if(!empty($closeButton))
            $arr['option']['closeButton'] = $this->closeButton;
        if(!empty($debug))
            $arr['option']['debug'] = $this->debug;
        if(!empty($progressBar))
            $arr['option']['progressBar'] = $this->progressBar;
        if(!empty($preventDuplicates))
            $arr['option']['preventDuplicates'] = $this->preventDuplicates;
        if(!empty($positionClass))
            $arr['option']['positionClass'] = $this->positionClass;
        if(!empty($onclick))
            $arr['option']['onclick'] = $this->onclick;
        if(!empty($showDuration))
            $arr['option']['showDuration'] = $this->showDuration;
        if(!empty($hideDuration))
            $arr['option']['hideDuration'] = $this->hideDuration;
        if(!empty($timeOut))
            $arr['option']['timeOut'] = $this->timeOut;
        if(!empty($extendedTimeOut))
            $arr['option']['extendedTimeOut'] = $this->extendedTimeOut;
        if(!empty($showEasing))
            $arr['option']['showEasing'] = $this->showEasing;
        if(!empty($hideEasing))
            $arr['option']['hideEasing'] = $this->hideEasing;
        if(!empty($showMethod))
            $arr['option']['showMethod'] = $this->showMethod;
        if(!empty($hideMethod))
            $arr['option']['hideMethod'] = $this->hideMethod;
    }
}