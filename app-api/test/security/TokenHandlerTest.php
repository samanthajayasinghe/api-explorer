<?php

/**
 * @author Samantha Jayasinghe
 *
 * Token Handler Test
 */

namespace Tests\Security;

use \PHPUnit_Framework_TestCase;
use APIExplorer\Security\TokenHandler;

class TokenHandlerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var TokenHandler
     */
    private $tokenHandler = null;

    public function setUp()
    {
        $this->tokenHandler = new TokenHandler('0278771688', 'a1ae9cb30fa533f4ad94tt');
    }

    public function testTokenEncrypt()
    {
        $token = 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..hrb6YWgxa5uoXQdlYcvnvg.OpreRvaKnGG1abJWrl3mpluYgQTlDg8NTdBF7p_S6R5NOqm9dVM5K4LOPCeDsnNPi9g9-MXUfTKFK-OlMAcrIqljM6GKPozoO0SpkAhZhTZ4lM0zq2HVN0iOoor4CKHgBMXOuOD0beV7kU6j8GQx-sMl1ywrJgXFPJewHAuFRKjJUhpBL5p1NZYx5jk2o3ExhMNRJYEzHD0U1EtLkvfLaNOz4qyhYWqnfMWPeED7uKt95s82QnMN78kdkETwl640ElEQp2BZo9nULV6IoG30TzzfF6G700TWw4feHIUcJO9FBnfAbEuUSwATwGBAmY066Yea66eb_uC7VXXJsSA-A7W3vIr4RpQ0J2icVmQCMh-vQMSMnqeO9L02rEroCWFuF4zYPV0xcvKVAlqClXZLrPEOVu92kU6sgz_zWDoFvAtPgxjtCzrzt__mq8izU_HGGO_6WU64ATp7AV7U6hL0mpmgxNGVNNRkjJxssJXKBRaucHE9Jvh9buhESjKC66eOvpATKyOUtqZwbDc9_XA8fVtOMSV_UXllIQuwPZyOMz-1LiBgf7nwr60X7RH3LPxeyMuXLKpHxvDz11FCsD6jMeqLSwNoULOMd2GTpRBVSLrKrOW6HTlyzkTNKxb4-tfcnfBA_XrUacOdFvxMn5nm98S_VLLNPbI2N6Lt6E4yeOSTHKz30B2eRZ19BkybF5GS.t0WLFaBwb2hcD9bi_5O0qg';
        $encryptedToken = $this->tokenHandler->encrypt($token);

        $this->assertEquals($token, $this->tokenHandler->decrypt($encryptedToken));
    }
}
