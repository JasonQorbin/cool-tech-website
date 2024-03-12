import remarkParse from './remark-parse';
import rehypeParse from './rehype-parse';
import remarkRehype from './remark-rehype';
import rehypeRemark from './rehype-remark';
import rehypeStringify from './rehype-stringify';
import remarkStringify from './remark-stringify';
import rehypeFormat from './rehype-format';
import remarkGfm from './remark-gfm';
import rehypeRaw from './rehype-raw';
import {unified}  from './unified';

console.log( "Test1");
function parseMarkdownToMarkup(markdownContent) {
    return new Promise(async function(resolve) {
        console.log("parsing markdown");
        const parser = await unified()
            .use(remarkParse)                                  //Parse Markdown
            .use(remarkGfm)                                    //GFM support (tables, autolists, tasklists/checkmark lists, strikethrough)
            .use(remarkRehype, {allowDangerousHtml: true})     //Convert to HTML
            .use(rehypeRaw)                                    //pass html tags through as-is
            .use(rehypeFormat)                                 //Format whitespace in HTML
            .use(rehypeStringify)
            .process(markdownContent);
        console.log("Done parsing markdown");
        resolve(String(parser));
    });
}

function parseMarkupToMarkdown(markdownContent) {
    return new Promise(async function(resolve) {
        console.log("parsing markdown");
        const parser = await unified()
            .use(rehypeParse)                                  //Parse HTML
            .use(rehypeRaw)                                    //pass html tags through as-is
            .use(rehypeRemark)                                 //Convert HTML to MarkdownMarkdown
            .use(remarkGfm)                                    //GFM support (tables, autolists, tasklists/checkmark lists, strikethrough)
            .use(remarkStringify)
            .process(markdownContent);
        console.log("Done parsing HTML");
        resolve(String(parser));
    });
}

//This script replaces the textarea above with an instance of the easyMDE markdown editor and places the article's content within
const htmlContent = `{{$articleToEdit->content}}`;
//const markdownContentPromise = parseMarkupToMarkdown(htmlContent);
// markdownContentPromise.then(
//     function(markdownContent){
//    });
const easyMDE = new EasyMDE();
easyMDE.value(htmlContent);

console.log( "Test2");
