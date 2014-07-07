<?php
/**
 * @author  volkov
 * @created 7/7/14 6:27 PM
 */

namespace Application\Info;

class Info
{

    const GIT_TAGS_LIST = 'git tag --list';
    const GIT_TAG_INFO = 'git log %s --pretty=oneline';

    public function getCommitsHistory()
    {
        // get all tags
        $tags = $this->convertShellOutputToArray(self::GIT_TAGS_LIST);
        arsort($tags);

        $commits = $this->getCommitsForTags($tags);
        return $commits;
    }

    public function getCommitsForTags($tags)
    {
        // first of all, get all periods for git log (0.1..0.2, 0.2..0.2.1 etc)
        $periods = [];

        foreach ($tags as $index => $tag) {
            // if it is a higher tag
            if ($tag == reset($tags)) {
                $periods['behind'] = $tag . '..HEAD';
            }

            $periods[$tag] = $tags[$index - 1] . '..' . $tag;

            if ($tag == end($tags)) {
                $periods[$tag] = $tag;
            }
        }

        // get hash and raw body for each commit
        $result = [];
        foreach ($periods as $key => $period) {
            $cmd = sprintf(self::GIT_TAG_INFO, $period);
            $commits = $this->convertShellOutputToArray($cmd);

            $result[$key]['count'] =  count($commits);
            foreach ($commits as $commit) {
                $result[$key]['commits'][] = explode(' ', $commit, 2);
            }

        }

        return $result;
    }

    public function convertShellOutputToArray($cmd)
    {
        return preg_split("@\n@", shell_exec($cmd), null, PREG_SPLIT_NO_EMPTY);
    }
}
