<?php namespace KouTsuneka\FlashMessage;

use \Illuminate\Session\SessionInterface;

class FlashMessageBuilder {
    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\SessionInterface
     */
    protected $session;

    /**
     * @var string
     */
    protected $flash_key = '_flash';

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Session\SessionInterface $session
     *
     * @return $this
     */
    public function set_session_store(SessionInterface $session)
    {
        $this->session = $session;

        return $this;
    }


    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function get_key()
    {
        return $this->flash_key;
    }

    /**
     * @param string $key
     */
    public function set_key($key)
    {
        $this->flash_key = $key;
    }

    /**
     * @param string $type
     * @param string $title
     * @param string $message
     * @param array $options
     * @return Message
     */
    public function make($type, $message, $title, $options = [])
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
        array_push($messages, $msg);
        $this->session->flash($this->flash_key, $messages);
        return $this;
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param array $options
     * @return FlashMessageBuilder
     */
    public function push($message, $title, $type = "success", $options = [])
    {
        $this->push_msg($this->make($type, $title, $message, $options));
        return $this;
    }

    /**
     * @return Message[]
     */
    public function get()
    {
        if($this->session->has($this->flash_key));
        {
            $messages = $this->session->get($this->flash_key);
            if($messages == null)
                return [];
            $this->session->set($this->flash_key, []);
            return $messages;
        }

        return [];
    }

    /**
     * @return array|string
     */
    public function encode()
    {
        if($this->session->has($this->flash_key));
        {
            $messages = $this->session->get($this->flash_key);
            if($messages == null)
                return json_encode([]);
            $this->session->set($this->flash_key, []);
            $encoded_messages = [];
            foreach($messages as $msg)
                array_push($encoded_messages, $msg->encode());
            $encoded_messages = '[' . implode(',', $encoded_messages) . ']';
            return $encoded_messages;
        }

        return json_encode([]);
    }
}
