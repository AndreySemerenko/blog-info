<?

namespace Core;

class Request
{
    CONST METHOD_GET = 'GET';
    CONST METHOD_POST = 'POST';
    public $get;
    public $post;
    public $server;
    public $rout;

    public function __construct(array $get, array $post, array $server)
    {
        $this->post = $post;
        $this->server = $server;

        $this->makeParams();
    }

    public function isGet()
    {
        return $this->server['REQUEST_METHOD'] == self::METHOD_GET;
    }

    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] == self::METHOD_POST;
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'];
    }

    private function makeParams()
    {
        $get = [];
        $buffer = explode("?", $this->server['REQUEST_URI']);
        $this->rout = $buffer[0];
        if (isset($buffer[1])) {
            $pairs = explode("&", $buffer[1]);
            foreach ($pairs as $pair) {
                $buf = explode("=", $pair);
                $get[$buf[0]] = $buf[1];
            }
        }
        $this->get = $get;
    }

}