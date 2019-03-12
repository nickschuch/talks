<?php

namespace Drupal\remote_article\Entity\RemoteArticleStore;

/**
 * Factory for returning our Remote Article client.
 *
 * This is a generated GRPC client. It uses a remote API for storing data.
 */
class RemoteArticleClientFactory {

    /**
     * {@inheritdoc}
     */
    public function get($host, $insecure) {
        $opts = array();

        if ($insecure) {
            $opts['credentials'] = \Grpc\ChannelCredentials::createInsecure();
        }

        return new \Articles\ArticlesClient($host, $opts);
    }


}