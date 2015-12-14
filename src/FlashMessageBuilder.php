<?php namespace KouTsuneka\FlashMessage;

use \Illuminate\Session\Store;

class FlashMessageBuilder {
    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * @var string
     */
    protected $flash_key = '_flash';

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }


    /**
     * @param string $type
     * @param string $title
     * @param string $message
     * @param array $options
     * @return Message
     */
    public function make($type, $title, $message, $options = [])
    {
        return new Message($type, $title, $message, $options);
    }


    /**
     * @param Message $msg
     * @return FlashMessageBuilder
     */
    public function push_msg(Message $msg)
    {
        $messages = [];
        if($this->session->has($this->flash_key))
            $messages = $this->session->get($this->flash_key);
        $message[] = $msg;
        $this->session->set($this->flash_key, $messages);
        return $this;
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param array $options
     * @return FlashMessageBuilder
     */
    public function push($title, $message, $type = "success", $options = [])
    {
        $this->push($this->make($type, $title, $message, $options));
        return $this;
    }
}