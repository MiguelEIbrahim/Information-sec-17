Information Security
Voting System Project
Group 17
Miguel Ibrahim
Alex L´opez
H´ector G´omez
Olivier Van Wassenhove
Isaac Vande Weghe
Stef Oss´e
May 10, 2024
Contents
1 Introduction 2
2 Context & History 2
2.1 Paper ballots . . . . . . . . . . . . . . . . . . . . . . . . . . . 3
2.2 Electronic voting . . . . . . . . . . . . . . . . . . . . . . . . . 3
2.3 Web-based voting . . . . . . . . . . . . . . . . . . . . . . . . . 3
3 Requirements 4
3.1 Voter Authentication . . . . . . . . . . . . . . . . . . . . . . . 4
3.2 Server Authentication . . . . . . . . . . . . . . . . . . . . . . 4
3.3 Voter Confidentiality . . . . . . . . . . . . . . . . . . . . . . . 4
3.4 Audit trail . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 5
3.5 Applicability . . . . . . . . . . . . . . . . . . . . . . . . . . . 5
4 Design 5
4.1 Hierarchy of servers . . . . . . . . . . . . . . . . . . . . . . . 5
4.2 Identity verification . . . . . . . . . . . . . . . . . . . . . . . . 6
4.3 One-shot vote key creation . . . . . . . . . . . . . . . . . . . 6
4.4 Voting . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 6
4.5 Voter Verification . . . . . . . . . . . . . . . . . . . . . . . . . 7
4.6 Vote Counting . . . . . . . . . . . . . . . . . . . . . . . . . . 8
4.7 Office Certificate Confirmation . . . . . . . . . . . . . . . . . 8
4.8 Miscellaneous security recommendations . . . . . . . . . . . . 8
5 Attack Effectiveness 8
5.1 Denial of Service attacks . . . . . . . . . . . . . . . . . . . . . 8
6 Conclusion 9
1
1 Introduction
In any democracy, free and fair elections are of utmost importance. Both
ease of access as well as security are especially relevant to those who which
to design or implement a balloting system. However, even in the digital age,
most voting systems still present a very manual and paper-bound process
which, while quite secure, may hamper voter participation.
In this report, the context and requirements of contemporary voting sys-
tems will be analysed, with a special focus on maintaining or even improving
the level of security that voters expect from paper-based voting. The design
of a proof-of-concept web-based voting system which fulfills these require-
ments will then be presented, and the system’s response to various kinds of
attacks will be examined.
2 Context & History
While simple voting mechanisms most likely date back to far further than
even the Ancient Greek ostracon 1, the rise of democracy prompted the de-
velopment of voting mechanisms which could fluently handle extremely large
numbers of votes, which is why the current diversity of voting mechanisms
are all relatively recent inventions.
To discuss these systems in further detail, we must first define some
terminology:
• Ballot: per-voter device used to record their vote
• Ballot collection: process by which all ballots are gathered and cen-
tralised in order to facilitate their counting
• Vote counting: process by which the votes recorded on the ballots
are tallied together
• Electoral system: determines how the votes are interpreted in order
to enact political change (e.g. majoritarian, proportional, first-past-
the-post, ...)
While electoral systems may impose certain requirements or restrictions on
voting systems, their design is a far more political subject, and so they will
not be mentioned further.
1In classical Athens, an ostracon was a broken shard of pottery on which citizens
could write the name of another citizen they wished to exile from the city: in essence, it
functioned as an earthenware ballot.
2
2.1 Paper ballots
Most contemporary ballot collection systems use some sort of electronic or
mechanical machinery in order to facilitate both the collection and counting
process.
The most widely used system is optical scan counting, wherein the
preprinted paper ballot is inserted and the vote is optically read from the
ballot and stored in the machine’s memory. This is opposed to manual
counting of ballots by election officials which is error-prone and somewhat
soul-draining. An advantage of this approach is that it still uses a paper
ballot: any errors with how the machine counts the votes may be verified
and, if deemed necessary, election officials can resort back to manual vote
counting.
2.2 Electronic voting
A direct-recording electronic voting system (DRE), on the other hand, does
away with paper ballots entirely. Voters can simply register their vote on
the machine itself, often through the means of an intuitive interface like
a touchscreen. The vote is subsequently stored in the machine’s memory,
which can be read out at the end of the voting period.
A potent criticism of DRE systems is that, because of its paperless na-
ture, it usually cannot provide a paper audit trail. However, most jurisdic-
tions require this functionality in order to legally organise elections. Hence,
most DRE solutions must implement some sort of a posteriori audit trail
functionality, which increases both their complexity and cost.
2.3 Web-based voting
Note how all of the previously discussed voting mechanisms are all still
primarily housed in the voting office, requiring the physical presence of the
voter (excluding absentee paper ballot systems like postal voting).
By using pre-existing internet infrastructure, web-based voting is capa-
ble of massively improving the ease of the voting process from a voter’s
perspective. Online voting comes with its own set of challenges, however,
as the entire system is now connected to a global network and no longer
closed-off. It is thus prone to attacks from hostile actors at scales that are
far larger than more traditional balloting systems. Therefore, ensuring the
security of online voting systems is extremely important.
To that end, an analysis of what would be required to make online sys-
tems as secure as their ancestors is necessary.
3
3 Requirements
3.1 Voter Authentication
Perhaps the most critical first step in designing a voting system is the veri-
fication of the voter’s identity, which should uniquely match a government-
issued identity. This guarantees that all votes are cast by real (and alive)
people, and allows the voting system to reject overvoting (more than one
vote per person). Every interaction of the voter with the system should thus
be adequately authenticated.
Because governments often have wildly different implementations of iden-
tity, a certain degree of adaptability is also required. For example, in the
US, there is no single federally recognised certificate of identity: this neces-
sitates a complex procedure of voter registration for each voter in order to
be able to vote, which usually derives identity from other documents such as
passports or state-issued driver’s licenses. In Belgium (and many countries
in the EU), federally-recognised ID cards are compulsory. 2
3.2 Server Authentication
Voting is a transaction between a voter and a government, and thus both
parties must be authenticated. When voting physically, this requirement
is often met very quickly, as election offices are announced beforehand by
trusted channels, and attempting to impersonate an election office would
both be very difficult and highly risky, all for a relatively small pay-off.
Servers, on the other hand, are very cheap, and impersonation of the vot-
ing server via one of many man-in-the-middle attacks could have disastrous
consequences for both the election and the misled voters. Any online voting
procedure should thus ensure that servers are authenticated, or clients must
at least a way of verifying that the server they are talking to is representative
of who they claim to be.
3.3 Voter Confidentiality
Most democracies hold the political privacy of every citizen in high regard:
every voter has the right not to disclose their vote to the public. Aside from
upholding this principle, secret ballots ensure that voters are not influenced
by political intimidation or blackmail. Ideally, secret ballot methodologies
ensure that even election officials cannot identify a voter from just the ballot.
In online voting systems, this requirement often comes in conflict with
voter authentication: a voting system must at the same time accurately
verify the identity of the voter while also not having the vote be traceable
back to them.
2In Belgium, eID cards have the added benefit of already having RSA keypairs embed-
ded into the card, which could be interfaced with.
4
3.4 Audit trail
As discussed in the previous sections, most election-holding bodies find the
existence of an audit trail very important.
Voters should be able to verify that their vote has been cast correctly
at any time, and election officials should be able to recount the collected
(secret) ballots at any time.
3.5 Applicability
Aside from the purely functional requirements outlined above, attention
should also be directed towards practical applicability of the system, espe-
cially in existing political/governmental contexts. The large-scale structure
of current voting systems should be reflected: this will have the added ben-
efit of making analogies with those systems more intuitive.
Ideally, adoption of an online voting system is also possible in a piece-
wise fashion: governments may wish to start at a low level in a small number
of municipalities and gradually scale up from there.
4 Design
4.1 Hierarchy of servers
This design envisions a network of different decentralised servers instead of
a single centralised ”election” server.
• Leaf office: interfaces with and authenticates the voter, usually cor-
responds to municipal-level servers
• Internal office: collects votes from leaf offices/children, forwards re-
sult to higher internal office or root office
• Root office: collects votes from internal offices/children and stores
the final election result
Depending on what kind of election is organized, these office types will
be assigned to different servers. For example, for a purely municipal election,
the municipal server will both act as a leaf office and as root office, while
during federal elections, municipal servers will act as leaf offices, provincial
servers will act as internal offices and a federal server will act as a root office.
This tree configuration is highly flexible and can be adjusted to accom-
modate almost all government hierarchies.
Each office also has its own office key-pair, with which it will sign every
single vote that passes through it.
5
4.2 Identity verification
It is assumed that the voter has access over a private key which confirms
their identity and that the leaf office has a corresponding public key that can
authenticate them. This private key is henceforth known as the voter’s iden-
tity key. As discussed previously, the way these keypairs are distributed
or even created are highly dependent on the government: in Belgium, this
identity key could simply be the private RSA key present in the eID chip:
municipalities can already access the corresponding public key.
4.3 One-shot vote key creation
The voter/client generates their own 4096-bit RSA keypair, which will be
used to perform the actual voting. The public part of this keypair is signed
with the identity key and then transmitted to the leaf office, which checks
the signature, immediately removes it and stores the public vote key. This
process is repeated up the office tree, so that the public vote key is checked
and stored by every office up until the root office. Upon confirmation of
this public vote key by the root office, the associated identity is marked as
having generated a vote key: the same identity can no longer generate vote
keys to prevent overvoting.
This vote key does not contain any identifying information of the
voter (after the removal of the signature), as the identity of the voter has
already been confirmed in the previous step. The key is dubbed ”one-shot”
considering it is only valid for a single election and thus for a maximum of
one vote.
4.4 Voting
With the vote key in hand, the client can commence voting. A 64-byte salt
is appended to the vote body (usually just an ID or a string denoting the
voted-on candidate) and the whole is encrypted with the private vote key.
The result is sent to the leaf office, which signs the encrypted ballot with
its office key, copies it locally into its ballot table and forwards it to the
upstream office together with the associated public vote key. The ballot
table associates every public vote key with its encrypted ballot. 3 Every
office that the vote passes through copies it to its own ballot table: this
facilitates auditing.
3The ballots could simply be decrypted and stored as plaintext without violating con-
fidentiality, but keeping them ensures every cast ballot is associated with a valid public
vote key. If decryption fails, this could imply tampering with the at-rest ballots, which
would otherwise go undetected.
6
4.5 Voter Verification
The client can verify the cast vote by making a request to the root office
with the public vote key. The root office can then check its ballot table and
return the encrypted ballot to the voter, who can decrypt it and subsequently
examine/verify its contents.vote pub. key id sig.
Voter Leaf Office Root Office
1
2
3 sig. in registry?
4
5 sig. in registry?
6
vote pub. key id sig.
7 store vote pub.
key in registry
8 store vote pub.
key in registry
9
Figure 1: Sequence diagram showcasing the vote key creation protocol.
1. Create private/public vote key pair (RSA, 4096 bits)
2. Sign public vote key with private identity key, send to leaf office
3. Check if signature’s identity is in the identity registry
4. If so, send to upstream office for further confirmation
5. Check if signature’s identity is in the identity registry
6. If so and if the root office...
7. Store the public vote key in a registry and return an OK to the down-
stream office
8. Repeat until back at the leaf office
9. Client receives OK from leaf office for vote key creation
7
4.6 Vote Counting
To count the votes at the end of an election period, the root office simply
iterates through its ballot table, decrypts every encrypted ballot with the
associated public vote key and tallies the vote appropriately.
4.7 Office Certificate Confirmation
Considering that the JavaScript code of the clients is provided by the leaf
offices themselves, any attempts at certificate pinning could easily be cir-
cumvented by an attacker by pinning their own certificate. In fact, any kind
of automated server authorisation technique will have to rely on client-side
code, which can be modified by an attacker.
Hence, voters should be instructed to explicitly check the CA of the
certificate: this is by far the most manual part of the entire system, but it
is a necessary evil to be able to adequately authorize the server.
4.8 Miscellaneous security recommendations
• Offices should be connected only through point-to-point VPNs, prefer-
ably WireGuard for easy configuration. Because of the tree structure,
adding, deleting or moving an office should only result in configuration
changes for a maximum of three offices.
• Root and internal offices should be restricted to these VPNs, essen-
tially closing them off from the rest of the internet.
• Voters should be advised not to vote from networks where man-in-the-
middle attacks are likely, like public WiFi networks.
5 Attack Effectiveness
5.1 Denial of Service attacks
One key vulnerability of the proposed design is its susceptibility to Denial
of Service attacks, which could be leveraged as a form of voter suppression.
This is especially true for very small, local elections, where only a single
leaf office may be active and could easily be targeted. It is a relatively
inescapable contrivance of the somewhat decentralised nature of the system.
For large elections (e.g.) federal where hundreds or even thousands of
leaf offices are active, DoS attacks will be much harder to perform, but could
still suppress a portion of the electorate.
8
6 Conclusion
It is clear that online voting systems have to account for the considerable
complexity of very high security demands and integration with government
services, while also delivering on the task of providing a fluent experience
for voters. In this report, requirements of such systems were examined and
a design was proposed that aims to meet most of them
