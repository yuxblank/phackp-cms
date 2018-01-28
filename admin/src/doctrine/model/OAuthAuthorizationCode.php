<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 03/12/17
 * Time: 20.20
 */

namespace cms\doctrine\model;
use cms\doctrine\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_authorization_code")
 */
class OAuthAuthorizationCode extends BaseEntity
{
    /** @ORM\Column(name="authorization_code", type="string") */
    protected $authorizationcode;
    /** @ORM\ManyToOne(targetEntity="OauthClient", fetch="LAZY")
     *  @ORM\JoinColumn(fieldName="id")
     * @var OAuthClient
     */
    protected $client;
    /** @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     *  @ORM\JoinColumn(fieldName="id")
     * @var User
     */
    protected $user;
    /** @ORM\Column(name="redirect_uri", type="string") */
    protected $redirect_uri;
    /** @ORM\Column(name="expires", type="string") */
    protected $expires;
    /** @ORM\Column(name="scope", type="string") */
    protected $scope;

}