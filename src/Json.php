<?php

namespace DeathSatan\Json;

use JsonException;

class Json
{
    public static $depth = 512;

    /**
     * 对变量进行 JSON 编码
     * @param mixed $value
     * 待编码的 value ，除了 资源(resource)  类型之外，可以为任何数据类型。
     * 所有字符串数据的编码必须是 UTF-8
     * @param int $option 由以下常量组成的二进制掩码：
     * JSON_HEX_TAG (int)
     * 所有的 < 和 > 转换成 \u003C 和 \u003E。 自 PHP 5.3.0 起生效。
     * JSON_HEX_AMP (int)
     * 所有的 & 转换成 \u0026。 自 PHP 5.3.0 起生效。
     * JSON_HEX_APOS (int)
     * 所有的 ' 转换成 \u0027。 自 PHP 5.3.0 起生效。
     * JSON_HEX_QUOT (int)
     * 所有的 " 转换成 \u0022。 自 PHP 5.3.0 起生效。
     * JSON_FORCE_OBJECT (int)
     * 使一个非关联数组输出一个类（Object）而非数组。 在数组为空而接受者需要一个类（Object）的时候尤其有用。 自 PHP 5.3.0 起生效。
     * JSON_NUMERIC_CHECK (int)
     * 将所有数字字符串编码成数字（numbers）。 自 PHP 5.3.3 起生效。
     * JSON_PRETTY_PRINT (int)
     * 用空白字符格式化返回的数据。 自 PHP 5.4.0 起生效。
     * JSON_UNESCAPED_SLASHES (int)
     * 不要编码 /。 自 PHP 5.4.0 起生效。
     * JSON_UNESCAPED_UNICODE (int)
     * 以字面编码多字节 Unicode 字符（默认是编码成 \uXXXX）。 自 PHP 5.4.0 起生效。
     * JSON_INVALID_UTF8_IGNORE 忽略无效的UTF-8字符
     * JSON_INVALID_UTF8_IGNORE 将无效的UTF-8字符转换为\0xfffd（Unicode字符“替换字符”）
     * JSON_OBJECT_AS_ARRAY 将JSON对象解码为PHP数组
     * @throws JsonException
     * @return string
     */
    public function encode($value, int $option = 0): string
    {
        $result = json_encode($value,$option,self::$depth);
        if ($this->check()){
            return $result;
        }else{
            throw new JsonException(json_last_error_msg());
        }
    }

    /**
     * 对 JSON 格式的字符串进行解码
     * 接受一个 JSON 编码的字符串并且把它转换为 PHP 变量
     * @param string $json 待解码的 json string 格式的字符串。这个函数仅能处理 UTF-8 编码的数据
     * @param bool $assoc 当该参数为 `true` 时，将返回`数组`而非`对象`
     * @param int $option 解码值
     * JSON_BIGINT_AS_STRING 将大数字编码成原始字符原来的值。
     * JSON_INVALID_UTF8_IGNORE 忽略无效的UTF-8字符
     * JSON_INVALID_UTF8_IGNORE 将无效的UTF-8字符转换为\0xfffd（Unicode字符“替换字符”）
     * JSON_OBJECT_AS_ARRAY 将JSON对象解码为PHP数组
     * @return null|bool|array|object
     * @throws JsonException
     */
    public function decode(string $json, bool $assoc = true, int $option = 0)
    {
        $result = json_decode($json,$assoc,self::$depth,$option);
        if ($this->check()){
            return $result;
        }else{
            throw new JsonException(json_last_error_msg());
        }
    }

    protected function check(): bool
    {
        if (json_last_error()===JSON_ERROR_NONE){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 设置编码深度
     * @param int $depth
     */
    public static function setDepth($depth)
    {
        self::$depth = $depth;
    }
}